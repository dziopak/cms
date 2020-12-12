<?php

namespace App\Services\Api;

use App\Http\Utilities\Api\AuthResponse;

class BaseApiService
{
    protected $events;
    protected $repository;

    public function index()
    {
        return ModelQueryService::build($this, $this->model)
            ->all()->scope()->toResource('collection');
    }


    public function show($id)
    {
    }


    public function store($data)
    {
        return ModelStoreService::build($this, $data);
    }


    public function update($data, $id = null)
    {
        return ModelUpdateService::build($this, $data, $id);
    }


    public function destroy($data, $id = null)
    {
        return ModelDestroyService::build($this, $data, $id);
    }


    static function response($message, $data = [], $status = 200)
    {
        return response()->json([
            "status" => $status,
            "message" => $message,
            "data" => $data ?? []
        ]);
    }


    public function getAccess($method)
    {
        $access = strtoupper($this->access . '_' . $method);
        AuthResponse::checkAccess($access);

        return $this;
    }


    public function getRepository()
    {
        return $this->repository ?? null;
    }


    public function getEvent($event)
    {
        return $this->events[$event] ?? null;
    }
}
