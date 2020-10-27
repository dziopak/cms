<?php

namespace App\Traits;

trait Sluggable
{
    public function scopeFindBySlug($query, $slug)
    {
        return $query->where('slug', $slug)
            ->orWhere('id', $slug)
            ->first();
    }

    public function getSlug()
    {
        return $this->slug;
    }


    public function generateSlug($title)
    {
        return strtolower(preg_replace(
            ['/[^\w\s]+/', '/\s+/'],
            ['', '-'],
            $title
        ));
    }


    public static function bootSluggable()
    {
        static::saving(function ($model) {
            $model->slug = $model->generateSlug($model->name);
        });
    }
}
