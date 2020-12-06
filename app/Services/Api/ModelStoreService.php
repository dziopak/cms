<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\DB;
use App\Exceptions\ModelStoreException;

class ModelStoreService
{
    private $items;


    public function __construct($service)
    {
        // Check access
        $service->getAccess('store');

        // Construct
        $this->service = $service;
        $this->repository = $service->getRepository();
    }


    private function storeItems($items)
    {
        DB::beginTransaction();
        try {
            foreach ($items as $item) {
                $res[] = $this->repository->store($item);
            }
            DB::commit();
        } catch (\Exception $e) {
            throw new ModelStoreException('Internal server error', 500);
            DB::rollback();
        }

        $this->items = $res;
        return true;
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
        $store = $this->storeItems($this->items);

        if ($store !== true) throw new ModelStoreException('Internal server error', 500);
        return $this->service->log('store', 'Items have been successfully stored.', 200, $this->items);
    }


    static function build($service, $data)
    {
        $class = new self($service);
        return $class->store($data);
    }
}
