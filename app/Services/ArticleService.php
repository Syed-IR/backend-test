<?php
namespace App\Services;

use App\Models\Article;
use App\Models\Category;
use App\Models\Source;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ArticleService
{
  public function dailyUpdate()
  {
    $newsSources        = config('newsSources');
    $newsSourceService  = new SourceDataTransformService;
    $sourceService      = new SourceService;
    $categories         = Category::limt(5)->get();
    $sources            = Source::all();

    foreach ($newsSources as $newsSource => $newsSourceConfig) {
      foreach ($categories as $category) {
        $data = HttpService::fetch($newsSourceConfig, $category);
        // $data = $this->data();
        $mappedData = $newsSourceService->$newsSource($data);
        $now = Carbon::now();
  
        foreach ($mappedData as $sourceToFilter => $artciles) {
          $result = $sourceService->filterOrCreate($sources, $sourceToFilter);
          $source = $result['source'];

          // Append source to source list if it is newly created to avoid db query
          if ($result['is_new'])
            $sources[$sources->count()] = $source;

          $articleToInsert = array_map(function($artcile) use($category, $source, $now) {
            return [...$artcile, "category_id" => $category->id, "source_id" => $source->id, "created_at" => $now, "updated_at" => $now];
          }, $artciles);
  
          Article::insert($articleToInsert);
        }
      }
    }
  }

  // private function data()
  // {
  //   $data = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/data.json");
  //   return json_decode($data, true);
  // }
}