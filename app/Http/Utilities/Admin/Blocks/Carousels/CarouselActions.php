<?php

namespace App\Http\Utilities\Admin\Blocks\Carousels;

use App\Entities\Carousel;
use Auth;

class CarouselActions
{
    protected $carousels;


    public function __construct($carousels)
    {
        $this->carousels = $carousels;
    }


    private function delete()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_DELETE');
        Carousel::whereIn('id', $this->carousels)->delete();

        return redirect(route('admin.blocks.carousels.index'))->with(['crud' => __('admin/messages.blocks.carousels.mass.delete')]);
    }

    public function mass($action)
    {
        switch ($action) {
            case 'delete':
                return $this->delete();
                break;
        }
    }
}
