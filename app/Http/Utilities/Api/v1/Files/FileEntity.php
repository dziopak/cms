<?php

namespace App\Http\Utilities\Api\Files;

use App\Entities\File;
use App\Interfaces\ApiEntity;

class FileEntity implements ApiEntity
{

    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    static function index($request)
    {
    }


    public function show()
    {
    }


    static function store($request)
    {
    }

    public function destroy()
    {
        $this->item->delete();
        return response()->json([
            'message' => __('admin/messages.files.delete.success'),
            'id' => $this->item->id,
            'data' => $this->item
        ], 200);
    }


    public function update($request)
    {
        $this->item->update([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);

        return response()->json([
            'message' => 'Success',
            'id' => $this->item->id,
            'data' => $this->item->fresh()
        ], 200);
    }
}
