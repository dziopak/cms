<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostsRequest;

use App\Http\Utilities\Admin\PostUtilities;
use App\Post;
use Auth;

class PostsController extends Controller
{

    public function index(Request $request)
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
        return PostUtilities::store($request);
    }


    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');
        return view('admin.posts.edit', ['post_id' => $id]);
    }


    public function update(PostsRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');
        return PostUtilities::update($id, $request);
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
        return PostUtilities::destroy($id);
    }

    public function mass(Request $request)
    {
        return PostUtilities::massAction($request);
    }
}
