<?php

namespace App\Http\Controllers\Admin\Modules\Blocks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlocksController extends Controller
{
    public function index()
    {
        return view('admin.blocks.index');
    }
}
