<?php
namespace App\Services;

use App\Models\Article;
use App\Models\Category;
use App\Models\Source;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SourceService
{
  /**
   * 
   */
  public function filterOrCreate($sources, $sourceToFilter): array 
  {
    $sourceToFilter = Str::lower($sourceToFilter);
    $is_new = false;

    $source = $sources->filter(function($v) use($sourceToFilter) {
      return $v->name == $sourceToFilter;
    })->first();
    
    if (!$source) {
      $source = Source::create([
        'name' => $sourceToFilter
      ]);
      $is_new = true;
  }

    return ['source' => $source, 'is_new' => $is_new];
  }
}