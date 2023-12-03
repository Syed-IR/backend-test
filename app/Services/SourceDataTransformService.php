<?php
namespace App\Services;

use App\Interfaces\SourceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SourceDataTransformService implements SourceInterface
{
  private $mappedArticles = [];

  /**
   * Map the source data to our db structure
   */
  public function newsapi($data): array
  {
    try {
      $articles = $data['articles'];
  
      foreach ($articles as $article) {
        $this->mapData($article['source']['name'], $article['author'], $article['title'], $article['description'], $article['url'], $article['publishedAt']);
      }
    } catch (\Throwable $th) {
      Log::channel('cron_log')->info("NEWSAPI");
      Log::channel('cron_log')->info(json_encode($data));
      Log::channel('cron_log')->info($th);
    }

    return $this->mappedArticles;
  }
  
  /**
   * Map the source data to our db structure
   */
  public function guardian($data): array
  {
    try {
      $articles = $data["response"]["results"];
      $source   = "The Guardian";
  
      foreach ($articles as $article) {
        $author       = array_key_exists(0, $article['tags']) ? $article['tags'][0]['webTitle'] : null;
        $description  = array_key_exists('trailText', $article['fields']) ? $article['fields']['trailText'] : null;
        $pub_date     = array_key_exists('lastModified', $article['fields']) ? $article['fields']['lastModified'] : null;
        
        $this->mapData($source, $author, $article['webTitle'], $description, $article['webUrl'], $pub_date);
      }
    } catch (\Throwable $th) {
      Log::channel('cron_log')->info("GUARDIAN");
      Log::channel('cron_log')->info(json_encode($data));
      Log::channel('cron_log')->info($th);
    }

    return $this->mappedArticles;
  }
  
  /**
   * Map the source data to our db structure
   */
  public function nyt($data): array
  {
    try {
      $articles = $data["response"]["docs"];
      $source   = "The New York Times";
      
      foreach ($articles as $article) {
        $this->mapData($source, $article['byline']['original'], $article['headline']['main'], $article['abstract'], $article['web_url'], $article['pub_date']);
      }
    } catch (\Throwable $th) {
      Log::channel('cron_log')->info("NYT");
      Log::channel('cron_log')->info(json_encode($data));
      Log::channel('cron_log')->info($th);
    }

    return $this->mappedArticles;
  }
  
  /**
   * @param string $source
   * @param string $author
   * @param string $title
   * @param string $description
   * @param string $url
   * @param string $published_at
   * @return void
   */
  private function mapData($source, $author, $title, $description, $url, $published_at)
  {
    $mappedData = [
      'author' => Str::substr($author, 0, 191),
      'title' => Str::substr($title, 0, 191),
      'description' => $description,
      'url' => $url,
      'published_at' => Carbon::parse($published_at),
    ];

    if (array_key_exists($source, $this->mappedArticles)) {
      array_push($this->mappedArticles[$source], $mappedData);
    } else {
      $this->mappedArticles[$source][] = $mappedData;
    }
  }
}