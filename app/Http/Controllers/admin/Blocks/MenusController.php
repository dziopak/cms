<?php

namespace App\Http\Controllers\Admin\Blocks;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\Blocks\Menus\CreateMenuRequest;
use App\Http\Requests\Admin\Blocks\Menus\UpdateMenuRequest;
use App\Http\Utilities\Admin\Blocks\Menus\MenuRelations;
use App\Http\Utilities\Admin\Blocks\Menus\MenuItems;
use App\Services\Admin\Menus\MenuActionService;
use App\Services\Admin\Menus\MenuService;
use Illuminate\Http\Request;
use Auth;

class MenusController extends BaseAdminController
{
    public $requests = [
        'store' => CreateMenuRequest::class,
        'update' => UpdateMenuRequest::class
    ];

    public function __construct(MenuService $service)
    {
        $this->service = $service;
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
        return MenuActionService::build($request);
    }
}
