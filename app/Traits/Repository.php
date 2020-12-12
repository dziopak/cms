<?php

namespace App\Traits;

trait Repository
{
    public function __call($method, $params)
    {
        return $this->model->$method(...$params);
    }

    public function getModel()
    {
        return new $this->model;
    }

    public function findMany($ids)
    {
        if (!method_exists($this->getModel(), 'findBySlug')) return $this->whereIn('id', $ids);
        return $this->whereIn('id', $ids)->orWhereIn('slug', $ids);
    }
}
