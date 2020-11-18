<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Post;

class PostsController extends Controller
{

    public function index(Request $request)
    {
        return Post::apiIndex($request);
    }


    public function store(Request $request)
    {
        return Post::apiStore($request);
    }


    public function show($id)
    {
        return Post::findOrFail($id)->apiShow();
    }


    public function update(Request $request, $id)
    {
        return Post::findOrFail($id)->apiUpdate($request);
    }


    public function destroy($id)
    {
        return Post::findOrFail($id)->apiDestroy();
    }
}
