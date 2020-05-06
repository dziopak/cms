<?php

namespace App\Http\Utilities\Admin;

use App\PageCategory;
use Auth;

class PageCategoryUtilities
{
    public static function update($id, $request)
    {
        $category = PageCategory::findOrFail($id);
        $data = $request->all();

        $category->update($data);
        return redirect(route('admin.pages.categories.index'));
    }


    public static function destroy($id)
    {
        $category = PageCategory::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully', 'id' => $id], 200);
    }


    public function massAction($request)
    {
        $data = $request->all();

        if (empty($data['mass_edit'])) {
            return redirect()->back()->with('error', 'No categories were selected.');
        } else {
            switch ($data['mass_action']) {
                case 'delete':
                    Auth::user()->hasAccessOrRedirect('CATEGORY_DELETE');
                    PageCategory::whereIn('id', $data['mass_edit'])->delete();
                    break;
            }
        }
        return redirect(route('admin.pages.categories.index'));
    }
}
