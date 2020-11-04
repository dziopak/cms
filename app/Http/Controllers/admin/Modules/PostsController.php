<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Utilities\Admin\Modules\Posts\PostEntity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Post;
use App\Http\Requests\Admin\Modules\Posts\PostsRequest;
use Auth;

class PostsController extends Controller
{

    public function index()
    {
        return view('admin.posts.index');
    }


    public function create()
    {
        Auth::user()->hasAccessOrRedirect('POST_CREATE');
        return view('admin.posts.create');
    }


    public function store(PostsRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('POST_CREATE');
        return PostEntity::store($request->all());
    }


    public function edit(Post $post)
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');
        return view('admin.posts.edit', ['post' => $post]);
    }


    public function update(Request $request, Post $post)
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');
        return PostEntity::update($post, $request);
    }


    public function delete(Post $post)
    {
        Auth::user()->hasAccessOrRedirect('POST_DELETE');
        return view('admin.posts.delete', compact('post'));
    }


    public function destroy(Post $post)
    {
        Auth::user()->hasAccessOrRedirect('POST_DELETE');
        return PostEntity::destroy($post);
    }

    public function mass(Request $request)
    {
        return PostEntity::massAction($request);
    }
}
