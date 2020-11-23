<?php

namespace App\Http\Utilities\Admin\Modules\Posts;

use App\Http\Utilities\Admin\Modules\Posts\PostFiles;
use App\Entities\Post;
use App\Interfaces\WebEntity;
use Auth;

class PostEntity implements WebEntity
{

    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }


    static function index($request)
    {
        Auth::user()->hasAccessOrRedirect('ADMIN_VIEW');
        $perPage = config('global')['content']['admin_posts_per_page'] ?? 15;

        return view('admin.posts.index', [
            'posts' => Post::with('author', 'thumbnail')->filter($request)->paginate($perPage)->onEachSide(2)
        ]);
    }


    static function create()
    {
        Auth::user()->hasAccessOrRedirect('POST_CREATE');
        return view('admin.posts.create');
    }

    static function store($request)
    {
        Auth::user()->hasAccessOrRedirect('POST_CREATE');

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        Post::create($data);

        return redirect(route('admin.posts.index'));
    }


    public function edit()
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');
        return view('admin.posts.edit', [
            'post' => $this->item
        ]);
    }


    public function update($request)
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');

        if ($request->get('request') === 'photo') {
            return (new PostFiles([$this->item->id]))->updateThumbnail($request->get('file'));
        }

        $this->item->update($request->except('thumbnail'));
        return redirect(route('admin.posts.index'));
    }


    public function destroy()
    {
        if (!Auth::user()->hasAccess('POST_DELETE')) {
            return redirect()->back()->with('error', 'You don\'t have rights to finish this action.');
        }

        $this->item->delete();

        return response()->json([
            'message' => __('admin/messages.posts.delete.success'),
            'id' => $this->item->id
        ], 200);
    }
}
