<?php

namespace App\Http\Controllers\Admin\Blocks;

use App\Entities\Carousel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blocks\Carousels\CreateCarouselRequest;
use App\Http\Requests\Admin\Blocks\Carousels\UpdateCarouselRequest;
use App\Http\Utilities\Admin\Blocks\Carousels\CarouselEntity;
use App\Http\Utilities\Admin\Blocks\Carousels\CarouselItems;
use Illuminate\Http\Request;
use App\Entities\File;

use Auth;

class CarouselsController extends Controller
{

    public function index()
    {
        return view('admin.blocks.carousels.index');
    }


    public function create()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_CREATE');
        return view('admin.blocks.carousels.create');
    }


    public function store(CreateCarouselRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_CREATE');

        $carousel = Carousel::create([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);

        return redirect(route('admin.blocks.carousels.index', $carousel->id));
    }


    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return view('admin.blocks.carousels.edit', ['carousel' => Carousel::findOrFail($id)]);
    }


    public function update(UpdateCarouselRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');

        File::flushQueryCache();
        Carousel::findOrFail($id)->files()->sync($request->get('image'));

        return redirect(route('admin.blocks.carousels.index'))->with('crud', __('admin/messages.blocks.carousels.update.success'));
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_DELETE');

        $carousel = Carousel::findOrFail($id)->delete();
        return response()->json(['message' => __('admin/messages.blocks.carousels.delete.success'), 'id' => $carousel->id], 200);
    }


    public function attach(Request $request, $id)
    {

        return (new CarouselItems($id))->attach($request->get('files'));
    }


    public function detach(Request $request, $id)
    {
        return (new CarouselItems($id))->detach($request->get('files'));
    }


    public function mass(Request $request)
    {
        return CarouselEntity::mass($request->all());
    }
}
