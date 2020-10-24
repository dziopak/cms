<?php

namespace App\Http\Utilities\Admin\Blocks\Sliders;

class SliderEntity
{
    public static function mass($data)
    {
        if (empty($data['mass_edit'])) {
            return redirect()->back();
        }

        return (new SliderActions($data['mass_edit']))->mass($data['mass_action']);
    }
}
