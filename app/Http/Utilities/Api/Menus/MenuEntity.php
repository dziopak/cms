<?php

namespace App\Http\Utilities\Api\Menus;

use App\Http\Utilities\Api\AuthResponse;
use App\Entities\Menu;
use App\Entities\MenuItem;
use App\Interfaces\ApiEntity;

class MenuEntity implements ApiEntity
{

    private $item;


    public function __construct($item)
    {
        $this->item = $item;
    }


    static function index($request)
    {
        return Menu::with('items')->paginate(15);
    }


    public function show()
    {
        if (!$this->item) return response()->json(['message' => 'Resource not found', 'status' => '404'], 404);
        return $this->item;
    }


    static function store($request)
    {
        $validation = MenuValidation::storeValidation($request);
        if ($validation !== true) return $validation;

        $menu = self::create($request);
        return response()->json([
            'message' => 'Successfully created menu',
            'data' => $menu,
            'status' => '201'
        ], 201);
    }


    public function update($request)
    {
        $validation = MenuValidation::updateValidation($request);

        if ($validation !== true) return $validation;
        if (!$this->item) return response()->json(['message' => 'Resource not found.', 'status' => 404], 404);

        $this->item->update($request->all());

        return response()->json([
            'message' => 'Successfully updated resource',
            'status' => '200',
            'data' => $this->item->fresh()
        ], 200);
    }


    public function destroy()
    {
        $access = AuthResponse::hasAccess('MENU_DELETE');

        if (!$access === true) return $access;
        if (!$this->item) return response()->json(['message' => 'Resource not found', 'status' => '404'], 404);

        $this->item->delete();

        return response()->json([
            'message' => 'Successfully deleted resource',
            'status' => '200',
            'data' => $this->item
        ], 200);
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
