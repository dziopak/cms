<?php

namespace App\Services\Api;

use App\Entities\Category;
use App\Http\Resources\CategoryResource;
use Spatie\QueryBuilder\QueryBuilder;


class CategoryQueryService
{
    private $filters = ['name', 'slug'];
    private $sorting = ['id'];
    private $query;
    private $request;


    public function __construct()
    {
        $this->request = request();
    }


    public function all()
    {
        $this->query = QueryBuilder::for(Category::class)
            ->allowedFilters($this->filters)
            ->allowedSorts($this->sorting)
            ->defaultSort('-id');
        return $this;
    }


    public function toResource($type)
    {
        switch ($type) {
            case 'collection':
                return CategoryResource::collection($this->query);
                break;
        }
    }


    public function scope()
    {
        $perpage = $this->request->get('perpage') ?? 15;
        $random = $this->request->get('random') ?? null;
        $limit = $this->request->get('limit') ?? null;

        if (!empty($random)) $this->query = $this->query->get()->random($random);
        else if (!empty($limit)) $this->query = $this->query->take($limit)->paginate($perpage);
        else $this->query = $this->query->paginate($perpage);

        return $this;
    }


    public function fetch()
    {
        return $this->query->get();
    }
}
