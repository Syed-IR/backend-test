<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'category'      => $this?->category?->name,
            'source'        => $this?->source?->name,
            'author'        => $this->author,
            'title'         => $this->title,
            'description'   => $this->description,
            'description'   => $this->description,
            'url'           => $this->url,
            'published_at'  => $this->published_at,
        ];
    }
}
