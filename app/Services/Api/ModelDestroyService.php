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


    private function dispatch($items)
    {
        // Dispatch events if assigned
        if (!empty($event = $this->service->getEvent('destroy'))) {
            foreach ($items as $item) {
                dispatchEvent($event, $item);
            }
        }
    }


    public function destroy()
    {
        // Get items
        $items = $this->items->dontCache()->get(['id', 'slug', 'name']);

        // Delete records & Throw errors
        if (exists($items)) $delete = $this->items->delete();
        if (!$delete) throw new ModelDestroyException('Failed to delete selected items', 501);

        // Dispatch events
        $this->dispatch($items);

        // Return response
        return response()->json([
            'message' => 'Items have been successfully deleted.',
            'status' => 200,
            'items' => $items
        ], 200);
    }


    private function getData($data, $id)
    {
        // Prepare IDs array
        $ids = $data['items'] ?? [$id];
        foreach ($ids as $key => $row) {
            $ids[$key] = (string) $row;
        }

        // Fetch items
        return $this->repository->whereIn('id', $ids)->orWhereIn('slug', $ids);
    }


    static function build($service, $data, $id = null)
    {
        $destroy = new self($service, $data, $id);
        return $destroy->destroy();
    }
}
