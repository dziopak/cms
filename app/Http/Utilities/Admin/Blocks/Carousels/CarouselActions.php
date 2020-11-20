<?php

namespace App\Http\Utilities\Admin\Blocks\Carousels;

use App\Events\Carousels\CarouselDestroyEvent;
use Auth;

class CarouselActions
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

        dispatchEvent(CarouselDestroyEvent::class, $this->items, function () {
            $this->items->delete();
            flushCache('slider');
        });

        return redirect(route('admin.blocks.carousels.index'))->with([
            'crud' => __('admin/messages.blocks.carousels.mass.delete')
        ]);
    }
}
