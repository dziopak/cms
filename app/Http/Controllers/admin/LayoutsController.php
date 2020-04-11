<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Layout;
use App\Block;
use Widget;
use Exception;

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
        $table = getData('admin/layouts/layouts_index_table');
        return view('admin.page_layouts.index', compact('layouts', 'table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $layout->widgets = unserialize($layout->widgets);
        $form = getData('admin/layouts/layouts_form');
        return view('admin.page_layouts.edit', compact('layout', 'form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', 'result']);
        $json = json_decode($request->get('result'), true);

        $layout = Layout::findOrFail($id);
        $sync = [];

        foreach ($json as $block) {
            $block_data = [];

            if (!empty($block['config']['title'])) {
                $block_data['title'] = $block['config']['title'];
                unset($block['config']['title']);
                $block_data['type'] = explode('-block', $block['type'])[0];
                $block_data['config'] = $block['config'];
            }

            $insert = Block::updateOrCreate(['id' => $block['id']], $block_data);
            $sync[$insert->id] = [
                'x' => $block['x'],
                'y' => $block['y'],
                'width' => $block['w'],
                'height' => $block['h']
            ];
        }


        $layout->blocks()->sync($sync);

        // usort($json, function ($string1, $string2) {
        //     return strcmp($string1['y'], $string2['y']);
        // });


        // foreach ($json as $block) {
        //     $block['id'] = explode('-block', $block['id'])[0];
        //     $blocks[$block['y']][] = $block;
        // }

        // foreach ($blocks as $key => $row) {
        //     usort($blocks[$key], function ($string1, $string2) {
        //         return strcmp($string1['x'], $string2['x']);
        //     });
        // }
        // $data['widgets'] = serialize($blocks);



        Layout::findOrFail($id)->update([
            "name" => $data['name'],
        ]);

        return redirect(route('admin.pages.layouts.index'))->with('crud', 'Layout created successfully.');
    }


    public function delete($id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getBlock(Request $request)
    {
        $widget = $request->get('name');

        if (empty($widget)) return response()->json('URL parameter "name" is missing.', 404);

        try {
            $widget = Widget::run('front.' . $widget, ['is_admin' => true]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => '404'], 404);
        }

        return response()->json((string) $widget, 200);
    }
}
