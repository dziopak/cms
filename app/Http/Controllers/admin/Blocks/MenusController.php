<?php

namespace App\Http\Controllers\Admin\Blocks;

use App\Http\Requests\Admin\Blocks\Menus\CreateMenuRequest;
use App\Http\Requests\Admin\Blocks\Menus\UpdateMenuRequest;
use App\Http\Utilities\Admin\Blocks\Menus\MenuRelations;
use App\Http\Utilities\Admin\Blocks\Menus\MenuItems;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Entities\Menu;
use Auth;

class MenusController extends Controller
{

    public function index(Request $request)
    {
        return Menu::webIndex($request);
    }

    public function create()
    {
        return Menu::webCreate();
    }

    public function store(CreateMenuRequest $request)
    {
        return Menu::webStore($request);
    }

    public function edit($id)
    {
        return Menu::findOrFail($id)->webEdit();
    }

    public function update(UpdateMenuRequest $request, $id)
    {
        return Menu::findOrFail($id)->webUpdate($request);
    }

    public function destroy($id)
    {
        return Menu::with('items')->findOrFail($id)->webDestroy();
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

    public function find(Request $request)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return MenuRelations::find($request->get('data'));
    }

    public function mass(Request $request)
    {
        return Menu::mass($request->all());
    }
}
