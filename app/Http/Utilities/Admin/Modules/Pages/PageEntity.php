<?php

namespace App\Http\Utilities\Admin\Modules\Pages;

use App\Http\Utilities\Admin\Modules\Pages\PageActions;
use App\Http\Utilities\Admin\Modules\Pages\PageFiles;
use App\Entities\Page;
use App\Interfaces\WebEntity;
use Auth;

class PageEntity implements WebEntity
{

    private $item;

    public function __construct($item)
    {
        $this->$item = $item;
    }


    static function index($request)
    {
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');
        return view('admin.pages.index');
    }


    static function create()
    {
        Auth::user()->hasAccessOrRedirect('PAGE_CREATE');
        return view('admin.pages.create');
    }


    static function store($request)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_CREATE');

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        Page::create($data);

        return redirect(route('admin.pages.index'));
    }


    public function edit()
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
        return view('admin.pages.edit', [
            'page' => $this->item
        ]);
    }


    public function update($request)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');

        if ($request->get('request') === 'photo') {
            return (new PageFiles([$this->item->id]))->updateThumbnail($request->get('file'));
        }

        $this->item->update($request->except('thumbnail'));
        return redirect(route('admin.pages.index'));
    }


    public function destroy()
    {
        Auth::user()->hasAccessOrRedirect('PAGE_DELETE');
        $this->item->delete();

        return response()->json(['message' => __('admin/messages.pages.delete.success'), 'id' => $this->item->id], 200);
    }


    static function mass($request)
    {
        $data = $request->all();

        if (empty($data['mass_edit'])) {
            return redirect()->back()->with('error', __('admin/messages.pages.mass.errors.no_posts'));
        }

        $msg = (new PageActions($data['mass_edit']))->mass($data);
        return redirect()->back()->with('crud', $msg);
    }
}
