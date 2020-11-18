<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Post;
use App\Http\Requests\Admin\Modules\Posts\PostsRequest;

class PostsController extends Controller
{

    public function index(Request $request)
    {
        return Post::webIndex($request);
    }

    public function create()
    {
        return Post::webCreate();
    }

    public function store(PostsRequest $request)
    {
        return Post::webStore($request);
    }

    public function edit($post)
    {
        return Post::findOrFail($post)->webEdit();
    }

    public function update(Request $request, $post)
    {
        return Post::findOrFail($post)->webUpdate($request);
    }

    public function destroy($post)
    {
        return Post::findOrFail($post)->webDestroy();
    }

    public function mass(Request $request)
    {
        return Post::mass($request);
    }
}
