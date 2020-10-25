<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Requests\Admin\Pages\Layouts\CreateLayoutRequest;
use App\Http\Requests\Admin\Pages\Layouts\UpdateLayoutRequest;
use App\Http\Utilities\Admin\Modules\Layouts\LayoutEntity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layout;
use Widget;
use Exception;

// TO DO //
// LAYOUTS ROLE ACCESS //

class LayoutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layouts = Layout::orderByDesc('id')->paginate(15);
        $table = getData('Admin/Modules/layouts/layouts_index_table');
        return view('admin.page_layouts.index', compact('layouts', 'table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = getData('Admin/Modules/layouts/layouts_form');
        return view('admin.page_layouts.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLayoutRequest $request)
    {
        return LayoutEntity::store($request);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $layout = Layout::with('blocks')->findOrFail($id);

        $form = getData('Admin/Modules/layouts/layouts_form');
        return view('admin.page_layouts.edit', compact('layout', 'form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLayoutRequest $request, $id)
    {
        return LayoutEntity::update($id, $request);
    }


    public function delete($id)
    {
        $layout = Layout::findOrFail($id);
        return view('admin.page_layouts.delete', compact('layout'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $layout = Layout::findOrFail($id);
        $layout->blocks()->delete();
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
