<?php

namespace App\Http\Utilities\Admin\Modules\Posts;

use App\Http\Utilities\Admin\Modules\Posts\PostActions;
use App\Http\Utilities\Admin\Modules\Posts\PostFiles;
use App\Entities\Post;
use Auth;

class PostEntity
{


    public static function store($data)
    {
        $data['user_id'] = Auth::user()->id;
        Post::create($data);

        return redirect(route('admin.posts.index'));
    }


    public static function update($id, $request)
    {
        if ($request->get('request') === 'photo') {
            return (new PostFiles([$id]))->updateThumbnail($request->get('file'));
        }

        Post::findOrFail($id)->update($request->except('thumbnail'));
        return redirect(route('admin.posts.index'));
    }


    public static function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return response()->json(['message' => __('admin/messages.posts.delete.success'), 'id' => $id], 200);
    }


    public static function massAction($request)
    {
        $data = $request->all();

        if (empty($data['mass_edit'])) {
            return redirect()->back()->with('error', __('admin/messages.posts.mass.errors.no_posts'));
        }

        $msg = (new PostActions($data['mass_edit']))->mass($data);
        return redirect()->back()->with('crud', $msg);
    }
}
