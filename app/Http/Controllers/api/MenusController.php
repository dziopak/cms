<?php

namespace App\Http\Controllers\Api;

use App\Http\Utilities\Api\Menus\MenuEntity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Menu;

class MenusController extends Controller
{
    public function index(Request $request)
    {
        return Menu::with('items')->paginate(15);
    }


    public function show($id)
    {
        return Menu::with('items')->findOrFail($id)->show();
    }


    public function store(Request $request)
    {
        return MenuEntity::store($request);
    }


    public function update($id, Request $request)
    {
        return MenuEntity::update($request, $id);
    }


    public function destroy($id)
    {
        return MenuEntity::destroy($id);
    }
}
