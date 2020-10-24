<?php

namespace App\Http\Utilities\Admin\Modules\Categories;

use App\PostCategory;
use Auth;

class PostCategoryEntity
{


    public static function store($request)
    {
        $data = $request->all();
        PostCategory::create($data);

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

        return response()->json(['message' => __('admin/messages.categories.delete.success'), 'id' => $id], 200);
    }


    public static function massAction($request)
    {
        $data = $request->all();

        if (empty($data['mass_edit'])) {
            return redirect()->back()->with('error', __('admin/messages.categories.mass.errors.no_categories'));
        }

        switch ($data['mass_action']) {
            case 'delete':
                Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
                PostCategory::whereIn('id', $data['mass_edit'])->delete();
                break;
        }

        return redirect(route('admin.posts.categories.index'));
    }
}
