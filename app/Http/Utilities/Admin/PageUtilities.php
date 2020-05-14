<?php

namespace App\Http\Utilities\Admin;

use App\Http\Utilities\ModelUtilities;
use App\Page;
use Auth;

class PageUtilities
{


    public static function store($request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        Page::create($data);
        return redirect(route('admin.pages.index'));
    }


    public static function update_thumbnail($id, $request)
    {
        $page = Page::findOrFail($id);
        $page->fire_events = false;
        $page->update(['file_id' => $request->get('file')]);

        if ($request->get('file') === 0) {
            $path = 'assets/no-thumbnail.png';
        } else {
            $path = \App\File::select('path')->findOrFail($request->get('file'))->path;
        }

        return $path;
    }


    public static function update($id, $request)
    {


        switch ($request->get('request')) {
            case 'photo':
                $path = PageUtilities::update_thumbnail($id, $request);
                $res = response()->json(['message' => 'Successfully updated page thumbnail.', 'file' => $request->get('file'), 'path' => $path]);
                break;

            default:
                $data = $request->except('thumbnail');
                Page::findOrFail($id)->update($data);
                $res = redirect(route('admin.pages.index'));
                break;
        }

        return $res;
    }


    public static function destroy($id)
    {
        Page::findOrFail($id)->delete();
        return response()->json(['message' => 'Page deleted successfully', 'id' => $id], 200);
    }


    public static function massAction($request)
    {
        $data = $request->all();
        if (empty($data['mass_edit'])) {
            return redirect()->back()->with('error', 'No pages were selected.');
        } else {
            switch ($data['mass_action']) {
                case 'delete':
                    Auth::user()->hasAccessOrRedirect('PAGE_DELETE');
                    Page::whereIn('id', $data['mass_edit'])->delete();
                    break;

                case 'hide':
                    Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
                    Page::whereIn('id', $data['mass_edit'])->update(['is_active' => 0]);
                    break;

                case 'show':
                    Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
                    Page::whereIn('id', $data['mass_edit'])->update(['is_active' => 1]);
                    break;

                case 'category':
                    // TO DO //
                    Auth::user()->hasAccessOrRedirect('PAGE_EDIT');
                    return redirect()->back()->with('error', 'Functionality not ready yet.');
                    break;
            }
        }
        return redirect(route('admin.pages.index'));
    }
}
