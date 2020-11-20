<?php

namespace App\Http\Utilities\Admin\Blocks\Sliders;

use App\Interfaces\WebEntity;
use App\Entities\Slider;
use Auth;

class SliderEntity implements WebEntity
{

    private $item;


    public function __construct($item)
    {
        $this->item = $item;
    }


    static function index($request)
    {
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');
        return view('admin.blocks.sliders.index');
    }


    static function create()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_CREATE');
        return view('admin.blocks.sliders.create');
    }

    static function store($request)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_CREATE');
        $slider = Slider::create(['name' => $request->get('name')]);

        return redirect(route('admin.blocks.sliders.edit', $slider->id));
    }

    public function edit()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return view('admin.blocks.sliders.edit', ['slider' => $this->item]);
    }

    public function update($request)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        $this->item->files()->sync($request->get('image'));

        return redirect(route('admin.blocks.sliders.index'))->with('crud', __('admin/messages.blocks.sliders.update.success'));
    }

    public function destroy()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_DELETE');
        $this->item->delete();

        return response()->json([
            'message' => __('admin/messages.blocks.sliders.delete.success'),
            'id' => $this->item->id
        ], 200);
    }
}
