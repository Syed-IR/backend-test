<?php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class HttpService
{
  /**
   * Fetch data from the news sources
   * @param array $newsSources
   * @param \App\Models\Category $category
   * @return json|bool
   */
  public static function fetch($newsSources, $category)
  {
    try {
      $url  = self::prepareUrl($newsSources, $category);

      $response = Http::acceptJson()
        ->withHeaders([
          'Content-Type' => 'application/json',
          'Accept'       => 'application/json'
        ])
        ->withToken($newsSources['api_key'])
        ->get($url);

      return $response->json();
    } catch (\Throwable $th) {
      info("HTTP_SERVICE_ERROR");
      info($th);
      return false;
    }
  }

  /**
   * @return string
   */
  private static function prepareUrl($newsSources, $category)
  {
    $currentDate = Carbon::now()->format("Y-m-d");
    return "{$newsSources["url"]}?q={$category->name}&{$newsSources["from_param"]}={$currentDate}&{$newsSources["to_param"]}={$currentDate}&{$newsSources["api_key_param"]}={$newsSources["api_key"]}";
  }
}
