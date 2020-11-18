<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class OfflineController extends Controller
{
    public function index()
    {
        $blocks = \App\Entities\Layout::findOrFail(1)->getLayout();
        return view('vendor.laravelpwa.offline', compact('blocks'));
    }
}
