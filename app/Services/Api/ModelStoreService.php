<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\DB;
use App\Exceptions\ModelStoreException;

class ModelStoreService
{
    private $items;


    public function __construct($service, $validator = null)
    {
        // Check access
        $service->getAccess('store');

        // Construct
        $this->service = $service;
        $this->repository = $service->getRepository();
        $this->validator = $validator;
    }


    private function storeItems($items)
    {
        $res = [];
        DB::beginTransaction();
        try {
            foreach ($items as $key => $item) {
                $res[] = $this->repository->create($item);
            }
            DB::commit();
        } catch (\Exception $e) {
            throw new ModelStoreException('Internal server error', 500);
            DB::rollback();
        }
        return $res;
    }


    protected function setItems($items)
    {
        $this->items = $items;
        return $this;
    }


    protected function getItems()
    {
        return $this->items;
    }


    private function getData($data)
    {
        $this->items = (isMany()) ? $data['items'] : [$data];
        return $this;
    }


    private function prepare()
    {
        return $this->items;
    }


    public function store($data)
    {
        $this->getData($data)->prepare();

        $validator = $this->validate();
        if (!empty($validator)) return response()->json($validator);

        $store = $this->storeItems($this->items);

        if (empty($store) || $store === false) throw new ModelStoreException('Internal server error', 500);
        return response()->json([
            'message' => 'Items have been successfully stored.',
            'items' => $store
        ], 200);
    }



    private function validate()
    {
        $res = [];
        foreach ($this->items as $item) {
            if (!empty($this->validator)) {
                $validation = $this->validator::validate($item);
                if (!empty($validation)) $res[] = $validation;
            }
        }
        return $res;
    }


    static function build($service, $data, $validator = null)
    {
        $class = new self($service, $validator);
        return $class->store($data);
    }
}
