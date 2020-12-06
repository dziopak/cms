<?php

namespace App\Services\Api;

use App\Http\Utilities\Api\AuthResponse;

class BaseApiService
{

    private $result;
    private $steps;
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
        ModelStoreService::build($this, $data);
        return $this;
    }


    public function update($data, $id = null)
    {
        ModelUpdateService::build($this, $data, $id);
        return $this;
    }


    public function destroy($data, $id = null)
    {
        ModelDestroyService::build($this, $data, $id);
        return $this;
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


    public function log($action, $message, $status = 200, $data = [])
    {
        $this->steps[$action] = ['message' => $message, 'status' => $status];

        $success = ($status >= 200 && $status < 300);

        $this->result = response()->json([
            'message' => $success ? 'Successfully performed selected tasks.' : "There were errors during performing selected tasks",
            'status' => $status,
            'actions' => $this->steps,
            'data' => $data
        ], $status);

        return $this;
    }

    public function respond()
    {
        return $this->result;
    }

    public function getRepository()
    {
        return $this->repository ?? null;
    }
}
