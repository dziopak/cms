<?php

namespace App\Http\Utilities\Admin\Blocks\Carousels;

use App\Entities\Carousel;
use App\Interfaces\WebEntity;
use App\Entities\File;
use Auth;

class CarouselEntity implements WebEntity
{

    private $item;


    public function __construct($item)
    {
        $this->item = $item;
    }


    static function index($request)
    {
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');
        return view('admin.blocks.carousels.index');
    }


    static function create()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_CREATE');
        return view('admin.blocks.carousels.create');
    }


    static function store($request)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_CREATE');

        $carousel = Carousel::create([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);

        return redirect(route('admin.blocks.carousels.index', $carousel->id));
    }


    public function edit()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return view('admin.blocks.carousels.edit', ['carousel' => $this->item]);
    }


    public function update($request)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');

        File::flushQueryCache();

        $this->item->files()->sync($request->get('image'));
        $this->item->update(['name' => $request->get('name')]);

        return redirect(route('admin.blocks.carousels.index'))->with('crud', __('admin/messages.blocks.carousels.update.success'));
    }


    public function destroy()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_DELETE');

        $this->item->delete();
        return response()->json(['message' => __('admin/messages.blocks.carousels.delete.success'), 'id' => $this->item->id], 200);
    }
}
