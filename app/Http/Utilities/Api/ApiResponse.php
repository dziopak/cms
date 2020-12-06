<?php

namespace App\Http\Utilities\Api;

use App\Exceptions\TransactionException;
use Illuminate\Support\Facades\DB;

class ApiResponse
{

    protected $items;
    private $result;
    private $steps;
    protected $repository;
    protected $access;


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

    public function getItems()
    {
        return $this->items ?? null;
    }
}
