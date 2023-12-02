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
    $category           = Category::first();
    $sources            = Source::all();

    foreach ($newsSources as $key => $newsSource) {
      $data = HttpService::fetch($newsSource, $category);
      // $data = $this->data();
      $mappedData = $newsSourceService->$key($data);
      $now = Carbon::now();

      foreach ($mappedData as $key => $artciles) {
        $filteredSource = $sources->filter(function($v) use($key) {
          return $v->name == Str::lower($key);
        })->first();
        
        if ($filteredSource) {
          $source_id = $filteredSource->id;
        } else {
          $source = Source::create([
            'name' => Str::lower($key)
          ]);
          $source_id = $source->id;
        }
        
        $articleToInsert = array_map(function($artcile) use($category, $source_id, $now) {
          return [...$artcile, "category_id" => $category->id, "source_id" => $source_id, "created_at" => $now, "updated_at" => $now];
        }, $artciles);

        Article::insert($articleToInsert);
      }
    }
  }

  private function data()
  {
    $data = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/data.json");
    return json_decode($data, true);
  }
}