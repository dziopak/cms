<?php

namespace Plugins\Testimonials\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Hook;

class TestimonialResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $array = [
            'id' => $this->id,
            'content' => $this->content,
            'author' => $this->author,
            'author_title' => $this->author_title,
            'thumbnail' => url('/images') . '/' . $this->thumbnail->path,
            'background_color' => $this->background_color
        ];

        $array = Hook::get('pluginTestimonialResource', [$array, $this], function ($array) {
            return $array;
        });

        return $array;
    }
}
