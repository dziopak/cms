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
        return view('admin.blocks.menus.index', [
            'menus' => Menu::paginate(15)
        ]);
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
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');

        $entities = [
            '0' => 'Custom url',
            'post' => 'Post',
            'page' => 'Page',
            'post_category' => 'Post category',
            'page_category' => 'Page category'
        ];

        return view('admin.blocks.menus.edit', [
            'entities' => $entities,
            'menu' => $this->item
        ]);
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
}
