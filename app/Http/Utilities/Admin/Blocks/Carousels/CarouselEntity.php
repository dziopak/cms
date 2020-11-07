<?php

namespace App\Http\Utilities\Admin\Blocks\Carousels;

class CarouselEntity
{
    public static function mass($data)
    {
        if (empty($data['mass_edit'])) {
            return redirect()->back();
        }

        return (new CarouselActions($data['mass_edit']))->mass($data['mass_action']);
    }
}
