<?php

namespace App\Http\Controllers\Admin\Blocks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blocks\Sliders\CreateSliderRequest;
use App\Http\Requests\Admin\Blocks\Sliders\UpdateSliderRequest;
use App\Http\Utilities\Admin\Blocks\Sliders\SliderEntity;
use App\Http\Utilities\Admin\Blocks\Sliders\SliderItems;
use Illuminate\Http\Request;

use Auth;

class SlidersController extends Controller
{

    public function index()
    {
        return view('admin.blocks.sliders.index');
    }


    public function create()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_CREATE');
        return view('admin.blocks.sliders.create');
    }


    public function store(CreateSliderRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_CREATE');

        $slider = \App\Entities\Slider::create(['name' => $request->get('name')]);
        return redirect(route('admin.blocks.sliders.edit', $slider->id));
    }


    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return view('admin.blocks.sliders.edit', ['slider' => \App\Entities\Slider::findOrFail($id)]);
    }


    public function update(UpdateSliderRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');

        \App\Entities\Slider::findOrFail($id)->files()->sync($request->get('image'));
        return redirect(route('admin.blocks.sliders.index'))->with('crud', __('admin/messages.blocks.sliders.update.success'));
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_DELETE');

        $slider = \App\Entities\Slider::findOrFail($id)->delete();
        return response()->json(['message' => __('admin/messages.blocks.sliders.delete.success'), 'id' => $slider->id], 200);
    }


    public function attach(Request $request, $id)
    {

        return (new SliderItems($id))->attach($request->get('files'));
    }


    public function detach(Request $request, $id)
    {
        return (new SliderItems($id))->detach($request->get('files'));
    }


    public function mass(Request $request)
    {
        return SliderEntity::mass($request->all());
    }
}
