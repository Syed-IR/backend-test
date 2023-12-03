<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SourceResource;
use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends BaseController
{
    public function index()
    {
        $sources = Source::all();
        return $this->response(true, SourceResource::collection($sources), [], "List of source", 200);
    }
}
