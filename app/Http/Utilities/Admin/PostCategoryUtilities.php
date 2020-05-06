<?php

namespace App\Http\Utilities\Admin;

use App\PostCategory;
use Auth;

class PostCategoryUtilities
{


    public static function store($request)
    {
        $data = $request->all();
        $category = PostCategory::create($data);

        return redirect(route('admin.posts.categories.index'));
    }


    public static function update($id, $request)
    {
        $category = PostCategory::findOrFail($id);
        $data = $request->all();

        $category->update($data);
        return redirect(route('admin.posts.categories.index'));
    }


    public static function destroy($id)
    {
        $category = PostCategory::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully', 'id' => $id], 200);
    }


    public static function massAction($request)
    {
        $data = $request->all();
        if (empty($data['mass_edit'])) {
            return redirect()->back()->with('error', 'No categories were selected.');
        } else {
            switch ($data['mass_action']) {
                case 'delete':
                    Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
                    PostCategory::whereIn('id', $data['mass_edit'])->delete();
                    break;
            }
        }
        return redirect(route('admin.posts.categories.index'));
    }
}
