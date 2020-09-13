<?php

namespace Plugins\Portfolio\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class PortfolioItemListResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {

        $categories = [];

        foreach ($this->categories as $category) {
            $categories[] = $category->id;
        }

        $array =  [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,

            'thumbnail' => url('/images') . '/' . $this->thumbnail->path,
            'thumb_color' => $this->thumb_color,
            'thumb_background' => $this->thumb_background,

            'categories' => $categories
        ];

        return $array;
    }
}
