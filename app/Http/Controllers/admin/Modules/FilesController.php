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


    public function store(Request $request)
    {
    }


    public function show($id)
    {
        $id === "0" ?
            $path = 'assets/no-thumbnail.png' :
            $path = \App\Entities\File::findOrFail($id)->path;

        return response()->json(['path' => $path]);
    }


    public function edit($id)
    {
        $file = File::findOrFail($id);
        return view('admin.media.edit', compact('file'));
    }


    public function update(Request $request, $id)
    {
        $file = File::findOrFail($id);
        $file->update([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);

        return redirect(route('admin.media.index'));
    }


    public function delete($id)
    {
        $file = \App\Entities\File::findOrFail($id);
        return view('admin.media.delete', compact('file'));
    }


    public function destroy($id)
    {
        \App\Entities\File::findOrFail($id)->delete();
        return response()->json(['message' => __('admin/messages.files.delete.success'), 'id' => $id], 200);
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
        } else {
            switch ($data['mass_action']) {
                case 'delete':
                    \App\Entities\File::whereIn('id', $data['mass_edit'])->delete();
                    return redirect()->back()->with('crud', __('admin/messages.files.mass.delete'));
                    break;

                default:
                    return redirect()->back();
                    break;
            }
        }
        return redirect()->back();
    }
}
