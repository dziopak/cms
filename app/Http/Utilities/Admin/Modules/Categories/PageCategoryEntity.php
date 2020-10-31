<?php

namespace App\Http\Utilities\Admin\Modules\Categories;

use App\Entities\PageCategory;
use Auth;

class PageCategoryEntity
{
    public static function update($category, $request)
    {
        $category->update($request->all());
        return redirect(route('admin.pages.categories.index'));
    }


    public static function destroy($category)
    {
        $category->delete();

        return response()->json(
            [
                'message' => __('admin/messages.categories.delete.success'),
                'id' => $category->id
            ],
            200
        );
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
                PageCategory::whereIn('id', $data['mass_edit'])->delete();
                break;
        }

        return redirect(route('admin.pages.categories.index'));
    }
}
