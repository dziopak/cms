<?php

namespace App\Http\Utilities\Admin\Modules\Files;

use App\Interfaces\WebEntity;
use File;
use Auth;

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
        Auth::user()->hasAccessOrRedirect('FILE_CREATE');
        return view('admin.media.create');
    }


    public function edit()
    {
        Auth::user()->hasAccessOrRedirect('FILE_EDIT');
        return view('admin.media.edit', [
            'file' => $this->item
        ]);
    }


    public function update($request)
    {
        Auth::user()->hasAccessOrRedirect('FILE_EDIT');
        $this->item->update([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);
        return redirect(route('admin.media.index'));
    }


    public function destroy()
    {
        if (!Auth::user()->hasAccess('FILE_DELETE')) {
            return redirect()->back()->with('error', 'You don\'t have rights to finish this action.');
        }

        $this->item->delete();

        return response()->json(
            [
                'message' => __('admin/messages.files.delete.success'),
                'id' => $this->item->id
            ],
            200
        );
    }
}
