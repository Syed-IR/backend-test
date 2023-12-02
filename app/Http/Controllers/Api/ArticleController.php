<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    /**
     * 
     */
    public function search(Request $request)
    {
        $articles = Article::all();
        return $this->response(true, ['articles' => new ArticleResource($articles)], [], "Search results", 200);
    }
}
