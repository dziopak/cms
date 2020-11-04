<?php

namespace App\Http\Utilities\Admin\Modules\Layouts;

use App\Http\Utilities\Admin\Modules\Layouts\LayoutBlocks;
use App\Entities\Layout;
use Auth;

class LayoutEntity
{
    public static function store($request)
    {
        $data = $request->except('config', '_token', 'result');
        $layout = Layout::create([
            'name' => $data['name'],
        ]);

        LayoutBlocks::updateBlocks($layout, $request);

        return redirect(route('admin.pages.layouts.index'))->with('crud', __('admin/messages.layouts.create.success'));
    }


    public static function update($layout, $request)
    {
        Auth::user()->hasAccessOrRedirect('LAYOUT_EDIT');

        LayoutBlocks::updateBlocks($layout, $request);
        $layout->update([
            "name" => $request->get('name'),
        ]);

        return redirect(route('admin.pages.layouts.index'))->with('crud', __('admin/messages.layouts.update.success'));
    }

    public static function destroy($layout)
    {
        Auth::user()->hasAccessOrRedirect('LAYOUT_DELETE');

        $layout->delete();
        return response()->json(['message' => __('admin/messages.pages.delete.success'), 'id' => $layout->id], 200);
    }
}
