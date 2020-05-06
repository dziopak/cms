<?php

namespace App\Http\Utilities\Admin;

use App\Http\Utilities\ModelUtilities;
use App\Post;
use Auth;

class PostUtilities
{
    public static function store($request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        Post::create($data);
        return redirect(route('admin.posts.index'));
    }


    public static function update($id, $request)
    {
        $data = ModelUtilities::makeDirtyRequest($request->file('thumbnail'), $request->except('thumbnail'));
        Post::findOrFail($id)->update($data);

        return redirect(route('admin.posts.index'));
    }


    public static function destroy($id)
    {
        $post = Post::findOrFail($id)->delete();
        return response()->json(['message' => 'Post deleted successfully', 'id' => $id], 200);
    }

    public static function massAction($request)
    {
        $data = $request->all();
        if (empty($data['mass_edit'])) {
            return redirect()->back()->with('error', 'No posts were selected.');
        } else {
            switch ($data['mass_action']) {
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
                    return redirect()->back()->with('error', 'Functionality not ready yet.');
                    break;
            }
        }
        return redirect(route('admin.posts.index'));
    }
}
