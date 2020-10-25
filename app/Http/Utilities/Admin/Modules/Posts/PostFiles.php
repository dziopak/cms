<?php

namespace App\Http\Utilities\Admin\Modules\Posts;

use App\Models\Post;
use Auth;

class PostFiles
{
    protected $posts;

    public function __construct($posts)
    {
        is_array($posts) ? $this->posts = $posts : $this->posts = [$posts];
    }

    public function updateThumbnail($file_id)
    {
        Auth::user()->hasAccessOrRedirect('POST_EDIT');
        $posts = Post::findOrFail($this->posts);

        foreach ($posts as $post) {
            $post->fire_events = false;
            $post->update(['file_id' => $file_id]);
            if ($file_id === 0) {
                $path = 'assets/no-thumbnail.png';
            } else {
                $path = \App\Models\File::select('path')->findOrFail($file_id)->path;
            }
        }

        return response()->json([
            'message' => __('admin/messages.posts.update.thumbnail.success'),
            'file' => $file_id,
            'path' => $path
        ]);
    }
}
