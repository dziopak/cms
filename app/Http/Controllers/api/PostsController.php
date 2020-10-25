<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utilities\Api\Posts\PostEntity;

class PostsController extends Controller
{

    public function index(Request $request)
    {
        return PostEntity::index($request);
    }


    public function store(Request $request)
    {
        return PostEntity::store($request);
    }


    public function show($id)
    {
        return PostEntity::show($id);
    }


    public function update(Request $request, $id)
    {
        return PostEntity::update($request, $id);
    }


    public function destroy($id)
    {
        return PostEntity::destroy($id);
    }
}
