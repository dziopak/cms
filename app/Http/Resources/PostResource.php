<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Hook;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $postResource = [
            'id' => $this->id,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'name' => $this->name,
            'slug' => $this->slug,
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'thumbnail' => !empty($this->file_id) && !empty($this->thumbnail) ? env('APP_URL') . '/images/' . $this->thumbnail->path : "",
            'author' => $this->author->name ?? null,
            'category' => $this->category->name ?? null,
            'category_id' => $this->category_id ?? null,
            'category_slug' => $this->category->slug ?? null,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'index' => $this->index,
            'follow' => $this->follow,
        ];
        $post = $this;

        $postResource = Hook::get('apiPostResource', [$postResource, $post], function ($postResource, $post) {
            return $postResource;
        });

        return $postResource;
    }
}
