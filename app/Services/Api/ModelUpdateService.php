<?php

namespace App\Services\Api;

use App\Exceptions\ModelUpdateException;
use App\Http\Utilities\Api\Files\FileHandling;
use DB;

class ModelUpdateService
{

    protected $items, $repository, $service;


    public function __construct($service, $data, $id = null, $items = null)
    {
        $service->getAccess('update');
        $this->service = $service;
        $this->items = $items ?? $this->getData($data, $id);
        $this->repository = $service->getRepository();
    }


    // *************************************************** //
    // **************** GETTERS / SETTERS **************** //
    // *************************************************** //
    protected function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

    protected function getItems()
    {
        return $this->items;
    }



    // *************************************************** //
    // ************** ACTUAL UPDATE METHODS ************** //
    // *************************************************** //
    protected function single($data)
    {
        $update = $this->items->first()->update($data);
        if (!$update !== true) throw new ModelUpdateException('Internal server error', 500);
        $this->service->log('update', 'Successfully updated single item.');

        return true;
    }

    protected function mass($data)
    {
        $update = $this->items->update($this->prepare($data));
        if ($update === false) throw new ModelUpdateException('Internal server error', 500);

        return true;
    }

    protected function bulk($data)
    {
        $result = [];
        DB::beginTransaction();
        try {
            foreach ($data as $item) {
                $model = $this->repository->find($item['id'] ?? $item['slug'])->respond();
                if (!empty($model->first())) {
                    $item = $this->prepare($item);
                    $model->update($item);
                    $result[] = $model->fresh();
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new ModelUpdateException('Internal server error', 500);
        }

        return true;
    }


    // *************************************************** //
    // ***************** DATA PREPARATION **************** //
    // *************************************************** //
    private function prepare($item)
    {
        if (!empty($item['name'])) $item['slug'] = generateSlug($item['name']);
        if (!empty($item['thumbnail'])) {
            $item['file_id'] = FileHandling::fromBlob($item['thumbnail']);
            unset($item['thumbnail']);
        }
        return $item;
    }


    private function getUpdateType($data)
    {
        $res = [];
        if (!empty($data['mass'])) $res[] = 'mass';
        if (!empty($data['bulk'])) $res[] = 'bulk';

        return empty($res) ? ['single'] : $res;
    }


    private function getData($data, $fallback = null)
    {
        if (empty($this->items)) {
            $ids = collect(array_merge($data['items'] ?? [], $data['bulk'] ?? []));
            $ids = $ids->map(function ($item) {
                return strval($item['id'] ?? $item);
            });

            if (empty($ids->first())) $ids = collect($fallback);
            return $this->service->model::whereIn('id', $ids)->orWhereIn('slug', $ids);
        }
    }


    // *************************************************** //
    // ******************* BOOT METHODS ****************** //
    // *************************************************** //
    public function update($request)
    {
        $this->setItems($this->items->dontCache());

        foreach ($this->getUpdateType($request) as $type) {
            $data = $request[$type] ?? $request;
            $update = $this->$type($data);

            if ($update !== true) throw new ModelUpdateException('Internal server error', 500);
        }

        return $this->service->log('update', 'Items have been successfully updated.', 200, $this->items->get()->fresh());
    }


    static function build($service, $data, $id = null)
    {
        $class = new self($service, $data, $id);
        return $class->update($data);
    }
}
