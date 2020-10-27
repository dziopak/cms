<?php

namespace App\Http\Utilities\Admin\Blocks\Menus;

use Auth;
use App\Entities\Menu;

class MenuActions
{

    protected $menus;

    public function __construct($menus)
    {
        is_array($menus) ? $this->menus = $menus : $this->menus = [$menus];
    }

    private function delete()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_DELETE');
        Menu::with('items')->whereIn('id', $this->menus)->delete();

        return redirect(route('admin.blocks.menus.index'))->with(['crud' => __('admin/messages.blocks.menus.mass.delete')]);
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
