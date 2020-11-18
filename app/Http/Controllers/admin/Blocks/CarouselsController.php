<?php

namespace App\Http\Controllers\Admin\Blocks;

use App\Entities\Carousel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blocks\Carousels\CreateCarouselRequest;
use App\Http\Requests\Admin\Blocks\Carousels\UpdateCarouselRequest;
use App\Http\Utilities\Admin\Blocks\Carousels\CarouselItems;
use Illuminate\Http\Request;

class CarouselsController extends Controller
{

    public function index(Request $request)
    {
        return Carousel::webIndex($request);
    }

    public function create()
    {
        return Carousel::webCreate();
    }

    public function store(CreateCarouselRequest $request)
    {
        return Carousel::webStore($request);
    }

    public function edit($id)
    {
        return Carousel::findOrFail($id)->webEdit();
    }

    public function update(UpdateCarouselRequest $request, $id)
    {
        return Carousel::findOrFail($id)->webUpdate($request);
    }

    public function destroy($id)
    {
        return Carousel::findOrFail($id)->destroy();
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
        return Carousel::mass($request);
    }
}
