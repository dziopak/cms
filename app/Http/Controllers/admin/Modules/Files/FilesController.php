<?php

namespace App\Http\Controllers\Admin\Modules\Files;

use App\Entities\File;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\BaseFormRequest;
use App\Services\Admin\Files\FileService;
use App\Http\Utilities\Api\Files\FileHandling;

class FilesController extends BaseAdminController
{
    public $requests = [
        'store' => BaseFormRequest::class,
        'update' => BaseFormRequest::class
    ];

    public function __construct(FileService $service)
    {
        $this->service = $service;
    }

    public function show($id)
    {
        $item = File::findOrFail($id);
        return response()->json([
            'id' => $item->id,
            'path' => $item->path
        ]);
    }

    public function store(BaseFormRequest $request)
    {
        return FileHandling::upload($request);
    }
}
