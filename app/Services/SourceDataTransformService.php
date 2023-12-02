<?php
namespace App\Services;

use App\Interfaces\SourceInterface;
use Carbon\Carbon;

class SourceDataTransformService implements SourceInterface
{
  public function newsapi($data): array
  {
    $articles = $data['articles'];
    $mappedArticles = [];

    foreach ($articles as $article) {
      $mappedData = $this->mapData($article['author'], $article['title'], $article['description'], $article['url'], $article['publishedAt']);
      $source     = $article['source']['name'];

      if (array_key_exists($source, $mappedArticles)) {
        array_push($mappedArticles[$source], $mappedData);
      } else {
        $mappedArticles[$source][] = $mappedData;
      }
      
    }

    return $mappedArticles;
  }
  
  public function guardian($data)
  {
    return [];
  }
  
  public function nyt($data)
  {
    return [];
  }
  
  private function mapData($author, $title, $description, $url, $published_at)
  {
    return [
      'author' => $author,
      'title' => $title,
      'description' => $description,
      'url' => $url,
      'published_at' => Carbon::parse($published_at),
    ];
  }
}