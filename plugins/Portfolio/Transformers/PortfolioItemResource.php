<?php

namespace Plugins\Portfolio\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\Media\ImageResource;
use Hook;

class PortfolioItemResource extends Resource
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

            'thumb_color' => $this->thumb_color,
            'thumb_background' => $this->thumb_background,

            'intro' => $this->intro,
            'description' => $this->description,

            'photos' => ImageResource::collection($this->photos),
            'categories' => $categories,
            'content' => $this->content_boxes ?? []
        ];

        $array = Hook::get('pluginPortfolioItemResource', [$array, $this], function ($array) {
            return $array;
        });

        return $array;
    }
}
