<?php

namespace App\Http\Utilities\Admin\Blocks\Sliders;

use App\Entities\Slider;
use App\Events\Sliders\SliderDestroyEvent;
use Auth;

class SliderActions
{

    protected $items;
    private $request;


    public function __construct($items, $request)
    {
        $this->items = $items;
        $this->request = $request;
    }


    public function delete()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_DELETE');

        dispatchEvent(SliderDestroyEvent::class, $this->items, function () {
            $this->items->delete();
            flushCache([
                'Slider'
            ]);
        });

        return redirect(route('admin.blocks.sliders.index'))->with(['crud' => __('admin/messages.blocks.sliders.mass.delete')]);
    }
}
