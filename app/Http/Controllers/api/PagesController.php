<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Utilities\Api\Pages\PageEntity;
use Illuminate\Http\Request;
use App\Entities\Page;

class PagesController extends Controller
{

    public function index(Request $request)
    {
        return Page::apiIndex($request);
    }

    public function store(Request $request)
    {
        return Page::apiStore($request);
    }

    public function show($id)
    {
        return Page::findBySlug($id)->apiShow();
    }

    public function update(Request $request, $id)
    {
        return Page::findBySlug($id)->apiUpdate($request);
    }

    public function destroy($id)
    {
        return Page::findBySlug($id)->apiDestroy();
    }
}
