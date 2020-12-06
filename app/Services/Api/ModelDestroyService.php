<?php

namespace App\Services\Api;

use App\Exceptions\ModelDestroyException;

class ModelDestroyService
{
    private $items;


    public function __construct($service, $data, $id = null)
    {
        // Check access
        $service->getAccess('delete');

        // Construct
        $this->service = $service;
        $this->repository = $service->getRepository();
        $this->items = $this->getData($data, $id);
    }


    public function destroy()
    {
        $items = $this->items->dontCache()->get(['id', 'slug', 'name']);
        if (exists($items)) $delete = $this->items->delete();

        if (!$delete) throw new ModelDestroyException('Failed to delete selected items', 501);
        return $this->service->log('delete', 'Items have been successfully deleted.', 200, $items);
    }


    private function getData($data, $id)
    {
        $ids = $data['items'] ?? $id;
        foreach ($ids as $key => $row) {
            $ids[$key] = (string) $row;
        }

        return $this->service->model::whereIn('id', $ids)->orWhereIn('slug', $ids);
    }


    static function build($service, $data, $id = null)
    {
        $destroy = new self($service, $data, $id);
        return $destroy->destroy();
    }
}
