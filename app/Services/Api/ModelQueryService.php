<?php

namespace App\Services\Api;

use App\Http\Resources\CategoryResource;
use Spatie\QueryBuilder\QueryBuilder;


class ModelQueryService
{
    private $filters = ['name', 'slug'];
    private $sorting = ['id'];
    private $query, $request;
    protected $service, $model;


    public function __construct($service, $model)
    {
        $this->request = request();
        $this->service = $service;
        $this->model = $model;
    }


    public function all()
    {
        $this->query = QueryBuilder::for($this->model)
            ->allowedFilters($this->filters)
            ->allowedSorts($this->sorting)
            ->defaultSort('-id');

        return $this;
    }


    public function toResource($type)
    {
        $model = new $this->model();
        return $model->resources[$type]::collection($this->query);
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


    static function build($service, $model)
    {
        return new self($service, $model);
    }
}
