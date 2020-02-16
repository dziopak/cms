<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PostsRequest;
use App\Post;
use App\Log;
use App\File;
use Illuminate\Support\Facades\Session;
use Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
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
        return view('admin.posts.create');
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
        return view('admin.posts.edit', compact('post'));
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
        if (!isset($data['index'])) {
            $data['index'] = 0;
        }
        if (!isset($data['follow'])) {
            $data['follow'] = 0;
        }
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
