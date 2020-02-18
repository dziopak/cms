<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostsRequest;
use Illuminate\Support\Facades\Session;

use App\Post;
use App\Log;
use App\File;
use App\PostCategory;
use Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('author', 'thumbnail')->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasAccessOrRedirect('POST_CREATE');

        $post_cat = new PostCategory;
        $categories[0] = 'No category';
        $categories = array_merge($categories, $post_cat->list_all());
        
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        Auth::user()->hasAccessOrRedirect('POST_CREATE');
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        
        if ($thumbnail = $request->file('thumbnail')) {
            $name = time(). '_' .$thumbnail->getClientOriginalName();
            $thumbnail->move('images/thumbnails', $name);
            
            $photo = File::create(['path' => 'thumbnails/'.$name, 'type' => '1']);
            $data['file_id'] = $photo->id;
        }

        $id = Post::create($data)->id;

        $log_data = [
            'user_id' => $data['user_id'],
            'target_id' => $id,
            'target_name' => $data['name'],
            'type' => 'POST',
            'crud_action' => '1',
            'message' => 'created new post'
        ];

        Log::create($log_data);
        Session::flash('crud', 'Post "'.$data['name'].'" has been created successfully.');

        return redirect(route('admin.posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');
        
        $post = Post::findOrFail($id);
        $post_cat = new PostCategory;
        $categories[0] = 'No category';
        $categories = array_merge($categories, $post_cat->list_all());
        
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsRequest $request, $id)
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');
        
        $post = Post::findOrFail($id);
        $data = $request->all();
        if ($thumbnail = $request->file('thumbnail')) {
            $name = time(). '_' .$thumbnail->getClientOriginalName();
            $thumbnail->move('images/thumbnails', $name);
            
            $photo = File::create(['path' => 'thumbnails/'.$name, 'type' => '1']);
            $data['file_id'] = $photo->id;
        }

        $log_data = [
            'user_id' => Auth::user()->id,
            'target_id' => $post->id,
            'target_name' => $data['name'],
            'type' => 'POST',
            'crud_action' => '2',
            'message' => 'edited post'
        ];
        $post->update($data);
        Log::create($log_data);
        Session::flash('crud', 'Post "'.$data['name'].'" has been updated successfully.');

        return redirect(route('admin.posts.index'));
    }

    public function delete($id) {
        Auth::user()->hasAccessOrRedirect('POST_DELETE');
        $post = Post::findOrFail($id);
        
        return view('admin.posts.delete', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::user()->hasAccessOrRedirect('POST_DELETE');
        $post = Post::findOrFail($id);

        $log_data = [
            'user_id' => $post->user_id,
            'target_id' => $post->id,
            'target_name' => $post->name,
            'type' => 'POST',
            'crud_action' => '3',
            'message' => 'deleted post'
        ];
        Session::flash('crud', 'Post "'.$post->name.'" has been deleted successfully.');
        
        $post->delete();
        Log::create($log_data);
        
        return redirect(route('admin.posts.index'));
    }
}
