<?php

namespace App\Http\Controllers\Admin\Blocks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use Auth;

class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::paginate(15);
        $table = getData('admin/blocks/sliders/sliders_index_table');
        return view('admin.blocks.sliders.index', compact('sliders', 'table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $slider = Slider::findOrFail($id);
        return view('admin.blocks.sliders.edit', compact('slider'));
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
        $slider = Slider::findOrFail($id);

        $data = $request->get('image');
        $slider->files()->sync($data);

        return redirect()->back();
    }


    public function delete()
    {
        return redirect()->back();
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


    public function attach(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->files()->sync($data = $request->get('files'), false);

        $slider = Slider::with('files')->findOrFail($id);

        $files = [];
        foreach ($slider->files as $image) {
            if (in_array($image->id, $data)) {
                $files[] = $image;
            }
        }

        return response()->json(['message' => 'Slides attached successfully', 'slides' => $data, 'files' => $files], 200);
    }


    public function detach(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $files = $request->get('files');

        $slider->files()->detach($files);
        return response()->json(['status' => 200, 'message' => 'Slides detached successfully.', 'slides' => $files], 200);
    }
}
