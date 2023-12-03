<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Category;
use App\Models\Source;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleService
{
  /**
   * 
   */
  public function dailyUpdate()
  {
    $newsSources        = config('newsSources');
    $newsSourceService  = new SourceDataTransformService;
    $sourceService      = new SourceService;
    $categories         = Category::all();
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

          // Append remaining details for the article
          $articleToInsert = array_map(function ($artcile) use ($category, $source, $now) {
            return [...$artcile, "category_id" => $category->id, "source_id" => $source->id, "created_at" => $now, "updated_at" => $now];
          }, $artciles);

          Article::insert($articleToInsert);
        }
      }
    }
  }

  /**
   * 
   */
  public function search(Request $request)
  {
    return Article::query()
      ->when(
        $request->q,
        function (Builder $builder) use ($request) {
          $builder->where(function ($q) use ($request) {
            $q->where('title', 'like', "%{$request->q}%")
              ->orWhere('description', 'like', "%{$request->q}%");
          });
        }
      )->when(
        $request->author,
        function (Builder $builder) use ($request) {
          $builder->where('author', 'like', "%{$request->author}%");
        }
      )->when(
        $request->category_id,
        function (Builder $builder) use ($request) {
          $builder->where('category_id', $request->category_id);
        }
      )->when(
        $request->source_id,
        function (Builder $builder) use ($request) {
          $builder->where('source_id', $request->source_id);
        }
      )->when(
        $request->from,
        function (Builder $builder) use ($request) {
          $builder->whereDate('published_at', ">=", Carbon::parse($request->from));
        }
      )->with(["category", "source"])->orderBy("published_at", 'desc')->get();
  }

  // private function data()
  // {
  //   $data = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/data.json");
  //   return json_decode($data, true);
  // }
}
