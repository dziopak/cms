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
            'name' => $this->name,
            'slug' => $this->slug,
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'thumbnail' => $this->file_id ? env('APP_URL').'images/'.$this->thumbnail->path : "",
            'author' => $this->author->name,
            'category' => $this->category_id ? $this->category->name : "",
            'category_id' => $this->category_id ? $this->category_id : "",
            'category_slug' => $this->category_id ? $this->category->slug : "",
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
        ];
        $page = $this;

        $pageResource = Hook::get('apiPageResource',[$pageResource, $page],function($pageResource, $page) {
            return $pageResource;
        });

        return $pageResource;
    }
}