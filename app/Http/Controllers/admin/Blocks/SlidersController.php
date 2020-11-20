<?php

namespace App\Http\Controllers\Admin\Blocks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blocks\Sliders\CreateSliderRequest;
use App\Http\Requests\Admin\Blocks\Sliders\UpdateSliderRequest;
use App\Http\Utilities\Admin\Blocks\Sliders\SliderEntity;
use App\Http\Utilities\Admin\Blocks\Sliders\SliderItems;
use Illuminate\Http\Request;
use App\Entities\Slider;

class SlidersController extends Controller
{

    public function index(Request $request)
    {
        return Slider::webIndex($request);
    }

    public function create()
    {
        return Slider::webCreate();
    }

    public function store(CreateSliderRequest $request)
    {
        return Slider::webStore($request);
    }

    public function edit($id)
    {
        return Slider::findOrFail($id)->webEdit();
    }

    public function update(UpdateSliderRequest $request, $id)
    {
        return Slider::findOrFail($id)->webUpdate($request);
    }

    public function destroy($id)
    {
        return Slider::findOrFail($id)->webDestroy();
    }

    public function attach(Request $request, $id)
    {

        return (new SliderItems($id))->attach($request->get('files'));
    }

    public function detach(Request $request, $id)
    {
        return (new SliderItems($id))->detach($request->get('files'));
    }

    public function mass()
    {
        return Slider::mass();
    }
}
