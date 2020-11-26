<?php

namespace App\Http\Utilities\Admin\Modules\Layouts;

use App\Http\Utilities\Admin\Modules\Layouts\LayoutBlocks;
use App\Entities\Layout;
use App\Interfaces\WebEntity;
use Auth;

class LayoutEntity implements WebEntity
{

    private $item;


    public function __construct($item)
    {
        $this->item = $item;
    }


    static function index($request)
    {
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');

        $layouts = Layout::orderByDesc('id')->paginate(15);

        return view('admin.page_layouts.index', compact('layouts'));
    }


    static function create()
    {
        Auth::user()->hasAccessOrRedirect('LAYOUT_CREATE');
        $form = getData('Admin/Modules/Layouts/layouts_form');

        return view('admin.page_layouts.create', compact('form'));
    }


    static function store($request)
    {
        Auth::user()->hasAccessOrRedirect('LAYOUT_CREATE');

        $data = $request->except('config', '_token', 'result');
        $layout = Layout::create([
            'name' => $data['name'],
        ]);

        LayoutBlocks::updateBlocks($layout, $request);

        return redirect(route('admin.pages.layouts.index'))->with('crud', __('admin/messages.layouts.create.success'));
    }


    public function edit()
    {
        Auth::user()->hasAccessOrRedirect('LAYOUT_EDIT');

        return view('admin.page_layouts.edit', [
            'form' => getData('Admin/Modules/Layouts/layouts_form'),
            'layout' => $this->item->load('blocks')
        ]);
    }


    public function update($request)
    {
        Auth::user()->hasAccessOrRedirect('LAYOUT_EDIT');

        LayoutBlocks::updateBlocks($this->item, $request);
        $this->item->update([
            "name" => $request->get('name'),
        ]);

        return redirect(route('admin.pages.layouts.index'))->with('crud', __('admin/messages.layouts.update.success'));
    }


    public function destroy()
    {
        if (!Auth::user()->hasAccess('LAYOUT_DELETE')) {
            return redirect()->back()->with('error', 'You don\'t have rights to finish this action.');
        }

        $this->item->delete();

        return response()->json([
            'message' => __('admin/messages.pages.delete.success'),
            'id' => $this->item->id
        ], 200);
    }
}
