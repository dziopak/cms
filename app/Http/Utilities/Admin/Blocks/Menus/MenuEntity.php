<?php

namespace App\Http\Utilities\Admin\Blocks\Menus;

use App\Http\Utilities\Admin\Blocks\Menus\MenuActions;

class MenuEntity
{
    public static function mass($data)
    {
        if (empty($data['mass_edit'])) {
            return redirect()->back();
        }

        return (new MenuActions($data['mass_edit']))->mass($data['mass_action']);
    }
}
