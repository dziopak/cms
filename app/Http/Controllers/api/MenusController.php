<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Harimayco\Menu\Models\MenuItems;
use Illuminate\Support\Facades\Validator;

use App\Http\Utilities\Validation;
use App\Http\Utilities\AuthResponse;
use App\Menu;
use JWTAuth;

class MenusController extends Controller
{
    public function index() {
        return Menu::with('items')->get();
    }

    public function show($id) {
        is_numeric($id) ? $menu = Menu::with('items')->find($id) : $menu = Menu::with('items')->where(['name' => $id])->first();
        
        if (!empty($menu)) {
            return $menu;
        } else {
            return response()->json(['message' => 'Resource not found', 'status' => '404'], 404);
        }
    }

    public function create(Request $request) {
        $access = AuthResponse::hasAccess('MENU_CREATE');
        if (!$access === true) {
            return $access;
        }

        $response = Validation::createMenu($data = $request->all());
        if ($response === true) {
            $menu = new Menu;
            $menu->name = $data['name'];
            $menu->save();
            
            foreach($data['items'] as $key => $item) {
                $data['items'][$key]['menu'] = $menu->id;
            }            
            $items = MenuItems::insert($data['items']);

            $menu = Menu::with('items')->find($menu->id);
            return response()->json(['message' => 'Successfully created menu', 'data' => $menu, 'status' => '201'], 201);
        } else {
            return $response;
        }
    }

    public function update($id, Request $request) {
        $menu = Menu::find($id);
        if (!$menu) return response()->json(['message' => 'Resource not found.', 'status' => 404], 404);

        if ($response = Validation::updateMenu($request->all()) !== true) return $response;
        
        $menu->update($request->all());

        return response()->json(['message' => 'Successfully updated resource', 'status' => '200', 'data' => $menu], 200);
    }

    public function destroy($id) {
        $access = AuthResponse::hasAccess('MENU_DELETE');
        if (!$access === true) return $access;

        $menu = Menu::with('items')->find($id);
        if ($menu) {
            $menu->delete();
            return response()->json(['message' => 'Successfully deleted resource', 'status' => '200', 'data' => $menu], 200);
        } else {
            return response()->json(['message' => 'Resource not found', 'status' => '404'], 404);
        }
    }
}
