<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Menu;
use Harimayco\Menu\Models\MenuItems;

class MenusController extends Controller
{
    public function index() {
        return Menu::with('items')->paginate(15);
    }
}
