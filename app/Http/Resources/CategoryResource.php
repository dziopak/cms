<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Hook;
use App\Http\Resources\PostResource;

class CategoryResource extends JsonResource
{
    
    static $wrap = null;
    
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
            'parent_id' => $this->parent_id,
        ];

        $category = $this;
        return $categoryResource = Hook::get('apiCategoryResource',[$categoryResource, $category],function($categoryResource, $category) {
            return $categoryResource;
        });
    }
}
