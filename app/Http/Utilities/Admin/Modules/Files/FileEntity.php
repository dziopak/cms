<?php

namespace App\Http\Utilities\Admin\Modules\Files;

use App\Interfaces\WebEntity;
use File;
use Auth;

// TO DO //
// MEDIA ACCESS //


class FileEntity implements WebEntity
{
    private $item;


    public function __construct($item)
    {
        $this->item = $item;
    }


    static function store($request)
    {
        return null;
    }


    static function index($request)
    {
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');
        return view('admin.media.index');
    }


    public function show()
    {
        $this->item->id === "0" ?
            $path = 'assets/no-thumbnail.png' :
            $path = $this->item->path;

        return response()->json(['path' => $path]);
    }


    static function create()
    {
        return view('admin.media.create');
    }


    public function edit()
    {
        return view('admin.media.edit', [
            'file' => $this->item
        ]);
    }


    public function update($request)
    {
        $this->item->update([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);
        return redirect(route('admin.media.index'));
    }


    public function destroy()
    {
        $this->item->delete();
        return redirect(route('admin.media.index'));
    }


    public function apiDestroy()
    {
        $this->item->delete();
        return response()->json([
            'message' => __('admin/messages.files.delete.success'),
            'id' => $this->item->id
        ], 200);
    }


    public function apiUpdate($request)
    {
        $this->item->update([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);
        return response()->json('success');
    }


    public function mass($request)
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
