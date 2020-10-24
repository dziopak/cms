<?php

namespace App\Http\Utilities\Admin\Modules\Pages;

use App\Http\Utilities\Admin\Pages\PageActions;
use App\Http\Utilities\Admin\Pages\PageFiles;
use App\Page;
use Auth;

class PageEntity
{

    public static function store($data)
    {
        $data['user_id'] = Auth::user()->id;
        Page::create($data);

        return redirect(route('admin.pages.index'));
    }


    public static function update($id, $request)
    {
        if ($request->get('request') === 'photo') {
            return (new PageFiles([$id]))->updateThumbnail($request->get('file'));
        }

        Page::findOrFail($id)->update($request->except('thumbnail'));
        return redirect(route('admin.pages.index'));
    }


    public static function destroy($id)
    {
        Page::findOrFail($id)->delete();
        return response()->json(['message' => __('admin/messages.pages.delete.success'), 'id' => $id], 200);
    }


    public static function massAction($request)
    {
        $data = $request->all();

        if (empty($data['mass_edit'])) {
            return redirect()->back()->with('error', __('admin/messages.pages.mass.errors.no_posts'));
        }

        $msg = (new PageActions($data['mass_edit']))->mass($data);
        return redirect()->back()->with('crud', $msg);
    }
}
