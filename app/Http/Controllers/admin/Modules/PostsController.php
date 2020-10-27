<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Utilities\Admin\Modules\Posts\PostEntity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Post;
use App\Http\Requests\PostsRequest;
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


    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');
        return view('admin.posts.edit', ['post_id' => $id]);
    }


    public function update(Request $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');
        return PostEntity::update($id, $request);
    }


    public function delete($id)
    {
        Auth::user()->hasAccessOrRedirect('POST_DELETE');
        $post = Post::findOrFail($id);

        return view('admin.posts.delete', compact('post'));
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('POST_DELETE');
        return PostEntity::destroy($id);
    }

    public function mass(Request $request)
    {
        return PostEntity::massAction($request);
    }
}
