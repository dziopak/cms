<?php

namespace App\Http\Controllers\Admin\Blocks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blocks\Sliders\CreateSliderRequest;
use App\Http\Requests\Admin\Blocks\Sliders\UpdateSliderRequest;
use App\Http\Utilities\Admin\Blocks\SliderUtilities;
use Illuminate\Http\Request;

use Auth;

class SlidersController extends Controller
{

    public function index()
    {
        return view('admin.blocks.sliders.index', compact('sliders', 'table'));
    }


    public function create()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_CREATE');
        return view('admin.blocks.sliders.create');
    }


    public function store(CreateSliderRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_CREATE');

        $slider = \App\Slider::create(['name' => $request->get('name')]);
        return redirect(route('admin.blocks.sliders.edit', $slider->id));
    }


    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return view('admin.blocks.sliders.edit', ['slider' => \App\Slider::findOrFail($id)]);
    }


    public function update(UpdateSliderRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');

        \App\Slider::findOrFail($id)->files()->sync($request->get('image'));
        return redirect(route('admin.blocks.sliders.index'))->with('crud', 'Slider successfully updated');
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_DELETE');

        $slider = \App\Slider::findOrFail($id)->delete();
        return response()->json(['message' => 'Slider successfuly deleted.', 'id' => $slider->id], 200);
    }


    public function attach(Request $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return SliderUtilities::attach($id, $request->get('files'));
    }


    public function detach(Request $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return SliderUtilities::detach($id, $request->get('files'));
    }

    public function mass(Request $request)
    {
        $data = $request->all();
        return SliderUtilities::mass($data);
    }
}
