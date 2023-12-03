<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HttpService
{
  /**
   * Fetch data from the news source
   * @param array $newsSource
   * @param \App\Models\Category $category
   * @return json|bool
   */
  public static function fetch($newsSource, $category)
  {
    try {
      $url  = self::prepareUrl($newsSource, $category);

      $response = Http::acceptJson()
        ->withHeaders([
          'Content-Type' => 'application/json',
          'Accept'       => 'application/json'
        ])
        ->get($url);

      return $response->json();
    } catch (\Throwable $th) {
      Log::channel('cron_log')->info("HTTP_SERVICE_ERROR");
      Log::channel('cron_log')->info($th);
      return false;
    }
  }

  /**
   * @return string
   */
  private static function prepareUrl($newsSource, $category)
  {
    $currentDate = Carbon::now()->format("Y-m-d");

    $urlBuilderService = new UrlBuilderService($newsSource);
    $url = $urlBuilderService
      ->setQuery($category->name)
      ->setFrom($currentDate)
      ->setTo($currentDate)
      ->build();

    return $url;
  }
}
