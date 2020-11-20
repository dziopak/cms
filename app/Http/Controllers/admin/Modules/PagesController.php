<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Modules\Pages\PagesRequest;
use App\Entities\Page;

class PagesController extends Controller
{

    public function index(Request $request)
    {
        return Page::webIndex($request);
    }

    public function create()
    {
        return Page::webCreate();
    }

    public function store(PagesRequest $request)
    {
        return Page::webStore($request);
    }

    public function edit($page)
    {
        return Page::findOrFail($page)->webEdit();
    }

    public function update(PagesRequest $request, $page)
    {
        return Page::findOrFail($page)->webUpdate($request);
    }

    public function destroy($page)
    {
        return Page::findOrFail($page)->webDestroy();
    }

    public function mass()
    {
        return Page::mass();
    }
}
