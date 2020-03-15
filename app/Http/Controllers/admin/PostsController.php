<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostsRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Utilities\TableData;

use App\Post;
use App\PostCategory;
use Auth;
use Redirect;

class PostsController extends Controller
{

    public function index(Request $request)
    {
        $posts = Post::with('author', 'thumbnail')->filter($request)->paginate(15);
        $table = TableData::postsIndex();
        return view('admin.posts.index', compact('posts', 'table'));
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

        $post = Post::create($data);
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

        $post->update($data);
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
        Session::flash('crud', 'Post "'.$post->name.'" has been deleted successfully.');
        
        return redirect(route('admin.posts.index'));
    }

    public function mass(Request $request) {
        $data = $request->all();
        if (empty($data['mass_edit'])) {
            return Redirect::back()->with('error', 'No posts were selected.');
        } else {
            switch($data['mass_action']) {
                case 'delete':
                    Auth::user()->hasAccessOrRedirect('POST_DELETE');
                    Post::whereIn('id', $data['mass_edit'])->delete();
                break;
                
                case 'hide':
                    Auth::user()->hasAccessOrRedirect('POST_EDIT');
                    Post::whereIn('id', $data['mass_edit'])->update(['is_active' => 0]);
                break;
                
                case 'show':
                    Auth::user()->hasAccessOrRedirect('POST_EDIT');
                    Post::whereIn('id', $data['mass_edit'])->update(['is_active' => 1]);
                break;
                
                case 'category':
                    // TO DO //
                    Auth::user()->hasAccessOrRedirect('POST_EDIT');
                    return Redirect::back()->with('error', 'Functionality not ready yet.');
                break;
            }
        }
        return redirect(route('admin.posts.index'));
    }
}
