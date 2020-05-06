<?php

namespace App\Http\Controllers\Admin\Blocks;

use App\Http\Controllers\Controller;
use App\Http\Utilities\Admin\Blocks\MenuUtilities;
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
    }


    public function store(Request $request)
    {
    }


    public function show($id)
    {
    }


    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return view('admin.blocks.menus.edit');
    }


    public function update(Request $request, $id)
    {
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_DELETE');

        Menu::findOrFail($id)->delete();
        return response()->json(['message' => 'Successfuly deleted a menu', 'id' => $id], 200);
    }


    public function order(Request $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return MenuUtilities::order($id, $request->get('data'));
    }


    public function attach(Request $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return MenuUtilities::attach($id, $request->get('data'));
    }


    public function detach($menu_id, $item_id)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');

        Menu::findOrFail($menu_id)->items()->findOrFail($item_id)->delete();
        return response()->json(['message' => 'Successfuly detached menu item', 'id' => $item_id], 200);
    }


    public function search(Request $request)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');
        return MenuUtilities::search($request->get('data'));
    }
}
