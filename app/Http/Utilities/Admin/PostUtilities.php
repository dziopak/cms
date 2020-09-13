<?php

namespace App\Http\Utilities\Admin;

use App\Http\Requests\PostsRequest;
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


    public static function update_photo($id, $request)
    {
        $post = Post::findOrFail($id);
        $post->fire_events = false;
        $post->update(['file_id' => $request->get('file')]);

        if ($request->get('file') === 0) {
            $path = 'assets/no-thumbnail.png';
        } else {
            $path = \App\File::select('path')->findOrFail($request->get('file'))->path;
        }

        return $path;
    }


    public static function update($id, $request)
    {
        Auth::user()->hasAccessOrRedirect('PAGE_EDIT');

        $type = $request->get('request');
        switch ($type) {

            case 'photo':
                // Thumbnail upload
                $path = PostUtilities::update_photo($id, $request);
                $res = response()->json(['message' => 'Successfully updated page thumbnail.', 'file' => $request->get('file'), 'path' => $path]);
                break;


            default:
                // Regular update
                Post::findOrFail($id)->update($request->except('thumbnail'));
                $res = redirect(route('admin.posts.index'));
                break;
        }

        return $res;
    }


    public static function destroy($id)
    {
        Post::findOrFail($id)->delete();
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

                case 'name_replace':
                    // --TO DO-- //
                    //   LANGS   //
                    //-----------//
                    Auth::user()->hasAccessOrRedirect('POST_EDIT');
                    $posts = Post::whereIn('id', $data['mass_edit'])->get(['id', 'name']);
                    $res = [];
                    foreach ($posts as $key => $post) {
                        if (strpos($post->name, $data['name_search_string']) !== false) {
                            $post->name = str_replace($data['name_search_string'], $data['name_replace_string'], $post->name);
                            $post->save();
                        }
                    }
                    return redirect()->back()->with('crud', 'Successfully replaced titles of multiple rows.');
                    break;

                case 'category':
                    Auth::user()->hasAccessOrRedirect('POST_EDIT');
                    Post::whereIn('id', $data['mass_edit'])->update(['category_id' => $data['category_id']]);
                    return redirect()->back()->with('crud', 'Successfully assigned category to selected posts.');
                    break;
            }
        }
        return redirect(route('admin.posts.index'));
    }
}
