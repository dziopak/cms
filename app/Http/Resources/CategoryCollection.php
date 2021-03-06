<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Hook;
use App\Http\Resources\PostResource;

class CategoryCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $categoryResource = [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'parent_id' => $this->category_id,
        ];
        $this->posts ? $categoryResource['posts'] = PostResource::collection($this->posts)->sortByDesc('created_at') : null;
        $this->pages ? $categoryResource['pages'] = PageResource::collection($this->pages) : null;

        $category = $this;
        return $categoryResource;
    }
}
