<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ArticleResource;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    /**
     * 
     */
    public function search(Request $request, ArticleService $articleService)
    {
        $articles = $articleService->search($request);
        return $this->response(true, ['total_results' => $articles->count(),'articles' => ArticleResource::collection($articles)], [], "Search results", 200);
    }
}
