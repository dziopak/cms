<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\File;
use App\Http\Utilities\Api\Files\FileHandling;

class FilesController extends Controller
{

    public function index(Request $request)
    {
        return File::webIndex($request);
    }

    public function create()
    {
        return File::webCreate();
    }

    public function show($file)
    {
        return File::findOrFail($file)->webShow();
    }

    public function edit($file)
    {
        return File::findOrFail($file)->webEdit();
    }

    public function update(Request $request, $file)
    {
        return File::findOrFail($file)->webUpdate($request);
    }

    public function destroy($file)
    {
        return File::findOrFail($file)->webDestroy();
    }

    public function store(Request $request)
    {
        return FileHandling::upload($request);
    }

    public function mass()
    {
        return File::mass();
    }
}
