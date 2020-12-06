<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Hook;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $pageResource = [
            'id' => $this->id,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'content' => $this->getContent(),
            'excerpt' => $this->getExcerpt(),
            'thumbnail' => $this->thumbnail ? env('APP_URL') . $this->getThumbnail() : "",
            'author' => $this->author ? $this->author->name : '',
            'meta_title' => $this->getMetaTitle(),
            'meta_description' => $this->getMetaDescription(),
        ];

        if (!empty($this->categories)) {
        }

        return $pageResource;
    }
}
