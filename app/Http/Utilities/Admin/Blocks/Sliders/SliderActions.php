<?php

namespace App\Http\Utilities\Admin\Blocks\Sliders;

use App\Entities\Slider;
use Auth;

class SliderActions
{
    protected $sliders;


    public function __construct($sliders)
    {
        $this->sliders = $sliders;
    }


    private function delete()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_DELETE');
        Slider::whereIn('id', $this->sliders)->delete();

        return redirect(route('admin.blocks.sliders.index'))->with(['crud' => __('admin/messages.blocks.sliders.mass.delete')]);
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
