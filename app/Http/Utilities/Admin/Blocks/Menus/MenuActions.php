<?php

namespace App\Http\Utilities\Admin\Blocks\Menus;

use Auth;
use App\Events\Menus\MenuDestroyEvent;

class MenuActions
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

        dispatchEvent(MenuDestroyEvent::class, $this->items, function () {
            $this->items->with('items')->delete();
            flushCache([
                'Menu',
                'MenuItem'
            ]);
        });

        return redirect(route('admin.blocks.menus.index'))->with(['crud' => __('admin/messages.blocks.menus.mass.delete')]);
    }
}
