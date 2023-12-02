<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Services\ArticleService;
use App\Services\HttpService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    /**
     * 
     */
    public function search(Request $request)
    {
        $articles = Article::query()
            ->when(
                $request->q,
                function (Builder $builder) use ($request) {
                    $builder->where(function($q) use ($request) {
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
                    $builder->whereDate('published_at', ">=" , Carbon::parse($request->from));
                }
            )->with(["category", "source"])->orderBy("published_at", 'desc')->get();

        return $this->response(true, ['total_results' => $articles->count(),'articles' => ArticleResource::collection($articles)], [], "Search results", 200);
    }

    /**
     * 
     */
    public function test(ArticleService $articleService)
    {
        $a = $articleService->dailyUpdate();
        return $this->response(true, $a, [], "Search results", 200);
    }
}
