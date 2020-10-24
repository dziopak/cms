<?php

namespace App\Http\Controllers\Admin\Blocks;

use App\Http\Requests\Admin\Blocks\Menus\CreateMenuRequest;
use App\Http\Requests\Admin\Blocks\Menus\UpdateMenuRequest;
use App\Http\Utilities\Admin\Blocks\Menus\MenuRelations;
use App\Http\Utilities\Admin\Blocks\Menus\MenuEntity;
use App\Http\Utilities\Admin\Blocks\Menus\MenuItems;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Menu;
use Auth;

class MenusController extends Controller
{

    public function index()
    {
        return view('admin.blocks.menus.index');
    }


    public function create()
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_CREATE');
        return view('admin.blocks.menus.create');
    }


    public function store(CreateMenuRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_CREATE');
        $menu = Menu::create([
            'name' => $request->get('name')
        ]);
        return redirect(route('admin.blocks.menus.edit', $menu->id));
    }


    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return view('admin.blocks.menus.edit');
    }


    public function update(UpdateMenuRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        Menu::findOrFail($id)->update([
            'name' => $request->get('name')
        ]);
        return redirect(route('admin.blocks.menus.index'));
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_DELETE');
        Menu::with('items')->findOrFail($id)->delete();

        return response()->json(['message' => __('admin/messages.blocks.menus.delete.success'), 'id' => $id], 200);
    }


    public function order(Request $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return (new MenuItems($id))->order($request->get('data'));
    }


    public function attach(Request $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return (new MenuItems($id))->attach($request->get('data'));
    }


    public function detach($menu_id, $item_id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return (new MenuItems($menu_id))->detach($item_id);
    }


    public function search(Request $request)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return MenuRelations::search($request->get('data'));
    }

    public function mass(Request $request)
    {
        return MenuEntity::mass($request->all());
    }
}
