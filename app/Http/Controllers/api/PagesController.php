<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Utilities\Api\Pages\PageEntity;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function index(Request $request)
    {
        return PageEntity::index($request);
    }


    public function store(Request $request)
    {
        return PageEntity::store($request);
    }


    public function show($id)
    {
        return PageEntity::show($id);
    }


    public function update(Request $request, $id)
    {
        return PageEntity::update($request, $id);
    }


    public function destroy($id)
    {
        return PageEntity::destroy($id);
    }
}
