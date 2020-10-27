<?php

namespace App\Http\Utilities\Api\Menus;

use App\Http\Utilities\Api\AuthResponse;
use App\Entities\Menu;
use App\Entities\MenuItem;

class MenuEntity
{
    static function show($id)
    {
        is_numeric($id) ? $menu = Menu::with('items')->find($id) : $menu = Menu::with('items')->where(['name' => $id])->first();

        if (!$menu) return response()->json(['message' => 'Resource not found', 'status' => '404'], 404);
        return $menu;
    }


    static function store($request)
    {
        $validation = MenuValidation::storeValidation($request);
        if ($validation !== true) return $validation;

        $menu = MenuEntity::create($request);
        return response()->json(['message' => 'Successfully created menu', 'data' => $menu, 'status' => '201'], 201);
    }


    static function update($request, $id)
    {
        $validation = MenuValidation::updateValidation($request);
        if ($validation !== true) return $validation;

        $menu = Menu::find($id);
        if (!$menu) return response()->json(['message' => 'Resource not found.', 'status' => 404], 404);

        $menu->update($request->all());
        return response()->json(['message' => 'Successfully updated resource', 'status' => '200', 'data' => $menu], 200);
    }


    static function destroy($id)
    {
        $access = AuthResponse::hasAccess('MENU_DELETE');
        if (!$access === true) return $access;

        $menu = Menu::with('items')->find($id);
        if (!$menu) return response()->json(['message' => 'Resource not found', 'status' => '404'], 404);

        $menu->delete();
        return response()->json(['message' => 'Successfully deleted resource', 'status' => '200', 'data' => $menu], 200);
    }


    static function create($request)
    {
        $data = $request->all();

        $menu = new Menu;
        $menu->name = $data['name'];
        $menu->save();

        foreach ($data['items'] as $key => $item) {
            $data['items'][$key]['menu'] = $menu->id;
        }

        MenuItem::insert($data['items']);

        return $menu = Menu::with('items')->find($menu->id);
    }
}
