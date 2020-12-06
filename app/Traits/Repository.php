<?php

namespace App\Traits;

use MrAtiebatie\Repository as MrAtiebatieRepository;

trait Repository
{
    use MrAtiebatieRepository;

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
