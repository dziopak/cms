<?php

namespace App\Http\Utilities\Admin\Blocks\Menus;

use App\Http\Utilities\Admin\Blocks\Menus\MenuActions;
use App\Entities\Menu;
use App\Interfaces\WebEntity;
use Auth;

class MenuEntity implements WebEntity
{

    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    static function index($request)
    {
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');
        return view('admin.blocks.menus.index');
    }

    static function create()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_CREATE');
        return view('admin.blocks.menus.create');
    }


    static function store($request)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_CREATE');
        $menu = Menu::create([
            'name' => $request->get('name')
        ]);

        return redirect(route('admin.blocks.menus.edit', $menu->id));
    }


    public function edit()
    {
        // TO DO //
        // GET VAR FROM VIEW COMPOSER //
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');

        $entities = [
            '0' => 'Custom url',
            'post' => 'Post',
            'page' => 'Page',
            'post_category' => 'Post category',
            'page_category' => 'Page category'
        ];

        return view('admin.blocks.menus.edit', compact('entities'));
    }


    public function update($request)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        $this->item->update([
            'name' => $request->get('name')
        ]);

        return redirect(route('admin.blocks.menus.index'));
    }


    public function destroy()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_DELETE');
        $this->item->delete();

        return response()->json(
            [
                'message' => __('admin/messages.blocks.menus.delete.success'),
                'id' => $this->item->id
            ],
            200
        );
    }


    static function mass($data)
    {
        if (empty($data['mass_edit'])) {
            return redirect()->back();
        }

        return (new MenuActions($data['mass_edit']))->mass($data['mass_action']);
    }
}
