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
        // Check access
        $service->getAccess('update');

        // Assign properties
        $this->service = $service;
        $this->items = $items ?? $this->getData($data, $id);
        $this->repository = $service->getRepository();
    }



    // Set items
    protected function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

    // Get items
    protected function getItems()
    {
        return $this->items;
    }



    // Single item update
    protected function single($data)
    {
        $update = $this->items->first()->update($data);
        if ($update !== true) throw new ModelUpdateException('Internal server error', 500);

        return true;
    }

    // Mass update - same values for multiple records
    protected function mass($data)
    {
        $update = $this->items->update($this->prepare($data));
        if ($update === false) throw new ModelUpdateException('Internal server error', 500);

        return true;
    }

    // Bulk updates - individual values for multiple records
    protected function bulk($data)
    {
        $result = [];
        DB::beginTransaction();
        try {
            foreach ($data as $item) {
                $model = $this->repository->find($item['id'] ?? $item['slug']);
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



    // Prepare data
    private function prepare($item)
    {
        if (!empty($item['name'])) $item['slug'] = generateSlug($item['name']);
        if (!empty($item['thumbnail'])) {
            $item['file_id'] = FileHandling::fromBlob($item['thumbnail']);
            unset($item['thumbnail']);
        }
        return $item;
    }

    // Define update type
    private function getUpdateType($data)
    {
        $res = [];
        if (!empty($data['mass'])) $res[] = 'mass';
        if (!empty($data['bulk'])) $res[] = 'bulk';

        return empty($res) ? ['single'] : $res;
    }

    // Get data from request
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



    // Boot method
    public function update($request)
    {
        $this->setItems($this->items->dontCache());

        foreach ($this->getUpdateType($request) as $type) {
            $data = $request[$type] ?? $request;
            $this->$type($data);
        }

        return response()->json([
            'message' => 'Items have been successfully updated.',
            'status' => '200',
            'items' => $this->items->get()->fresh()
        ], 200);
    }



    static function build($service, $data, $id = null)
    {
        $class = new self($service, $data, $id);
        return $class->update($data);
    }
}
