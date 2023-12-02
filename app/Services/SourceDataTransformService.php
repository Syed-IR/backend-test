<?php
namespace App\Services;

use App\Interfaces\SourceInterface;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SourceDataTransformService implements SourceInterface
{
  private $mappedArticles = [];

  /**
   * 
   */
  public function newsapi($data): array
  {
    $articles = $data['articles'];

    foreach ($articles as $article) {
      $this->mapData($article['source']['name'], $article['author'], $article['title'], $article['description'], $article['url'], $article['publishedAt']);
    }

    return $this->mappedArticles;
  }
  
  /**
   * 
   */
  public function guardian($data): array
  {

    return [];
  }
  
  /**
   * 
   */
  public function nyt($data): array
  {
    $articles = $data["response"]["docs"];
    $source   = "The New York Times";
    
    foreach ($articles as $article) {
      $this->mapData($source, $article['byline']['original'], $article['headline']['main'], $article['abstract'], $article['web_url'], $article['pub_date']);
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