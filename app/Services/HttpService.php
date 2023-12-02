<?php
namespace App\Services;

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
      // info("HTTP_SERVICE_ERROR");
      // info($th);
      throw($th);
      return false;
    }
  }

  /**
   * @return string
   */
  private static function prepareUrl($newsSources, $category)
  {
    return "{$newsSources["url"]}?q={$category->name}&{$newsSources["from_param"]}=2023-11-27&{$newsSources["to_param"]}=2023-11-27&{$newsSources["api_key_param"]}={$newsSources["api_key"]}";
  }
}
