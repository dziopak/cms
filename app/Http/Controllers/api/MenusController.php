<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Harimayco\Menu\Models\MenuItems;
use Illuminate\Support\Facades\Validator;

use App\Http\Utilities\MenuUtilities;
use App\Http\Utilities\AuthResponse;
use App\Menu;
use JWTAuth;

class MenusController extends Controller
{
    public function index() {
        return Menu::with('items')->paginate(15);
    }


    public function show($id) {
        is_numeric($id) ? $menu = Menu::with('items')->find($id) : $menu = Menu::with('items')->where(['name' => $id])->first();
        
        if (!$menu) return response()->json(['message' => 'Resource not found', 'status' => '404'], 404);
        return $menu;
    }


    public function store(Request $request) {
        $validation = MenuUtilities::storeValidation($request);
        if ($validation !== true) return $validation;

        $menu = MenuUtilities::create($request);
        return response()->json(['message' => 'Successfully created menu', 'data' => $menu, 'status' => '201'], 201);
    }


    public function update($id, Request $request) {
        $validation = MenuUtilities::updateValidation($request);
        if ($validation !== true) return $validation;

        $menu = Menu::find($id);
        if (!$menu) return response()->json(['message' => 'Resource not found.', 'status' => 404], 404);

        $menu->update($request->all());
        return response()->json(['message' => 'Successfully updated resource', 'status' => '200', 'data' => $menu], 200);
    }


    public function destroy($id) {
        $access = AuthResponse::hasAccess('MENU_DELETE');
        if (!$access === true) return $access;

        $menu = Menu::with('items')->find($id);
        if (!$menu) return response()->json(['message' => 'Resource not found', 'status' => '404'], 404);
        
        $menu->delete();
        return response()->json(['message' => 'Successfully deleted resource', 'status' => '200', 'data' => $menu], 200);
        
    }
}
