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

        // TO DO //
        // MOVE TO COMPOSER //
        $table = getData('Admin/Modules/Layouts/layouts_index_table');
        // // // //

        return view('admin.page_layouts.index', compact('layouts', 'table'));
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
            'layout' => Layout::findOrFail($this->item)->load('blocks')
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
        Auth::user()->hasAccessOrRedirect('LAYOUT_DELETE');

        $this->item->delete();
        return response()->json(['message' => __('admin/messages.pages.delete.success'), 'id' => $this->item->id], 200);
    }
}
