<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Requests\Admin\Pages\Layouts\CreateLayoutRequest;
use App\Http\Requests\Admin\Pages\Layouts\UpdateLayoutRequest;
use App\Http\Utilities\Admin\Modules\Layouts\LayoutEntity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Layout;
use Widget;
use Exception;

// TO DO //
// LAYOUTS ROLE ACCESS //

class LayoutsController extends Controller
{

    public function index()
    {
        $layouts = Layout::orderByDesc('id')->paginate(15);
        $table = getData('Admin/Modules/Layouts/layouts_index_table');
        return view('admin.page_layouts.index', compact('layouts', 'table'));
    }


    public function create()
    {
        $form = getData('Admin/Modules/Layouts/layouts_form');
        return view('admin.page_layouts.create', compact('form'));
    }


    public function store(CreateLayoutRequest $request)
    {
        return LayoutEntity::store($request);
    }


    public function edit(Layout $layout)
    {
        return view('admin.page_layouts.edit', [
            'form' => getData('Admin/Modules/Layouts/layouts_form'),
            'layout' => $layout->load('blocks')
        ]);
    }


    public function update(UpdateLayoutRequest $request, Layout $layout)
    {
        return LayoutEntity::update($layout, $request);
    }


    public function delete(Layout $layout)
    {
        return view('admin.page_layouts.delete', compact('layout'));
    }


    public function destroy(Layout $layout)
    {
        $layout->delete();
        return redirect(route('admin.pages.layouts.index'))->with('crud', __('admin/messages.layouts.delete.success'));
    }


    public function getBlock(Request $request)
    {
        $widget = $request->get('name');

        if (empty($widget)) return response()->json('URL parameter "name" is missing.', 404);

        try {
            $widget = Widget::run('Blocks.' . $widget, ['is_admin' => true]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => '404'], 404);
        }

        return response()->json((string) $widget, 200);
    }
}
