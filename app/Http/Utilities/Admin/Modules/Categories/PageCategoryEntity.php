<?php

namespace App\Http\Utilities\Admin\Modules\Categories;

use App\Entities\PageCategory;
use App\Interfaces\WebEntity;
use Illuminate\Http\Request;
use Auth;

class PageCategoryEntity implements WebEntity
{

    private $item;


    public function __construct($item)
    {
        $this->item = $item;
    }


    static function index($request)
    {
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');
        return view('admin.page_categories.index');
    }


    static function create()
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_CREATE');
        return view('admin.page_categories.create');
    }


    static function store($request)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_CREATE');
        PageCategory::create($request->all());

        return redirect(route('admin.pages.categories.index'));
    }


    public function edit()
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');
        return view('admin.page_categories.edit', [
            'category' => $this->item
        ]);
    }


    public function update($request)
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_EDIT');
        $this->item->update($request->all());

        return redirect(route('admin.pages.categories.index'));
    }


    public function destroy()
    {
        Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
        $this->item->delete();

        return redirect(route('admin.pages.categories.index'));
    }


    public function apiUpdate(Request $request)
    {
        $access = Auth::user()->hasAccess('CATEGORY_EDIT');
        if (!$access) return response()->json('No access');

        $result = $this->item->update($request->all());
        if (!$result) return response()->json('fail');

        return response()->json('success');
    }


    public function apiDestroy()
    {
        $access = Auth::user()->hasAccess('CATEGORY_DELETE');
        if (!$access) return response()->json('No access');

        $result = $this->item->delete();
        if (!$result) return response()->json('fail');

        return response()->json(
            [
                'message' => __('admin/messages.categories.delete.success'),
                'id' => $this->item->id
            ],
            200
        );
    }


    static function mass($request)
    {
        $data = $request->all();

        if (empty($data['mass_edit'])) {
            return redirect()->back()->with('error', __('admin/messages.categories.mass.errors.no_categories'));
        }

        switch ($data['mass_action']) {
            case 'delete':
                Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
                PageCategory::whereIn('id', $data['mass_edit'])->delete();
                break;
        }

        return redirect(route('admin.pages.categories.index'));
    }
}
