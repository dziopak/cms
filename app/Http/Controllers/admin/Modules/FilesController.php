<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\File;
use App\Http\Utilities\Api\Files\FileHandling;

class FilesController extends Controller
{


    public function index()
    {
        return view('admin.media.index');
    }


    public function create()
    {
        return view('admin.media.create');
    }


    public function show(File $file)
    {
        $file->id === "0" ?
            $path = 'assets/no-thumbnail.png' :
            $path = $file->path;

        return response()->json(['path' => $path]);
    }


    public function edit(File $file)
    {
        return view('admin.media.edit', ['file' => $file]);
    }


    public function update(Request $request, File $file)
    {
        $file->update([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);

        return redirect(route('admin.media.index'));
    }


    public function delete(File $file)
    {
        return view('admin.media.delete', compact('file'));
    }


    public function destroy(File $file)
    {
        $file->delete();
        return response()->json(['message' => __('admin/messages.files.delete.success'), 'id' => $file->id], 200);
    }


    public function upload(Request $request)
    {
        return FileHandling::upload($request);
    }


    public function mass(Request $request)
    {
        $data = $request->all();

        if (empty($data['mass_edit'])) {
            return redirect()->back()->with('error', __('admin/messages.files.mass.errors.no_files'));
        }

        switch ($data['mass_action']) {
            case 'delete':
                File::whereIn('id', $data['mass_edit'])->delete();
                return redirect()->back()->with('crud', __('admin/messages.files.mass.delete'));
                break;
        }

        return redirect()->back();
    }
}
