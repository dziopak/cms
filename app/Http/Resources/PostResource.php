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
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'index' => $this->index,
            'follow' => $this->follow,
        ];

        return $postResource;
    }
}
