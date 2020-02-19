<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostsRequest;
use Illuminate\Support\Facades\Session;

use App\Events\Posts\PostCreateEvent;
use App\Events\Posts\PostUpdateEvent;
use App\Events\Posts\PostDestroyEvent;

use App\Post;
use App\PostCategory;
use Auth;

class PostsController extends Controller
{
    
    public function index()
    {
        $posts = Post::with('author', 'thumbnail')->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    
    public function create()
    {
        Auth::user()->hasAccessOrRedirect('POST_CREATE');

        $post_cat = new PostCategory;
        $categories[0] = 'No category';
        $categories = array_merge($categories, $post_cat->list_all());
        
        return view('admin.posts.create', compact('categories'));
    }

    
    public function store(PostsRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('POST_CREATE');
        
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $thumbnail = $request->file('thumbnail');

        $post = Post::create($data);
        event(new PostCreateEvent($post, $thumbnail));
        Session::flash('crud', 'Post "'.$data['name'].'" has been created successfully.');

        return redirect(route('admin.posts.index'));
    }

    
    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');
        
        $post = Post::findOrFail($id);
        $post_cat = new PostCategory;
        $categories[0] = 'No category';
        $categories = array_merge($categories, $post_cat->list_all());
        
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    
    public function update(PostsRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');
        
        $post = Post::findOrFail($id);
        $data = $request->all();
        $thumbnail = $request->file('thumbnail');        

        $post->update($data);
        event(new PostUpdateEvent($post, $thumbnail));
        Session::flash('crud', 'Post "'.$data['name'].'" has been updated successfully.');

        return redirect(route('admin.posts.index'));
    }


    public function delete($id) {
        Auth::user()->hasAccessOrRedirect('POST_DELETE');
        $post = Post::findOrFail($id);
        
        return view('admin.posts.delete', compact('post'));
    }


    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('POST_DELETE');
        $post = Post::findOrFail($id);

        $post->delete();
        event(new PostDestroyEvent($post));
        Session::flash('crud', 'Post "'.$post->name.'" has been deleted successfully.');
        
        return redirect(route('admin.posts.index'));
    }
}
