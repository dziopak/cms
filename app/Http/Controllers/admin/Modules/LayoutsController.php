<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Requests\Admin\Modules\Layouts\CreateLayoutRequest;
use App\Http\Requests\Admin\Modules\Layouts\UpdateLayoutRequest;
use App\Http\Utilities\Admin\Modules\Layouts\LayoutEntity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Layout;
use Auth;
use Exception;

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
        Auth::user()->hasAccessOrRedirect('LAYOUT_CREATE');

        $form = getData('Admin/Modules/Layouts/layouts_form');
        return view('admin.page_layouts.create', compact('form'));
    }


    public function store(CreateLayoutRequest $request)
    {
        return LayoutEntity::store($request);
    }


    public function edit(Layout $layout)
    {
        Auth::user()->hasAccessOrRedirect('LAYOUT_EDIT');

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
        Auth::user()->hasAccessOrRedirect('LAYOUT_DELETE');
        return view('admin.page_layouts.delete', compact('layout'));
    }


    public function destroy(Layout $layout)
    {
        return LayoutEntity::destroy($layout);
    }


    public function getBlock(Request $request)
    {
        if (empty($request->get('name'))) return response()->json('URL parameter "name" is missing.', 404);

        try {
            $name = camelCase($request->get('name'));
            $name = 'App\View\Components\Admin\Blocks\\' . ucfirst($name);
            $block = (object) [
                'id' => $request->get('name'),
                'x' => 0,
                'y' => 0,
                'auto' => true
            ];
            $widget = new $name($block, true);
            $widget = $widget->render();
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => '404'], 404);
        }

        return response()->json((string) $widget, 200);
    }
}
