<?php

namespace App\Http\Utilities\Admin\Modules\Layouts;

use App\Http\Utilities\Admin\Layouts\LayoutBlocks;
use App\Layout;

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


    public static function update($id, $request)
    {
        $layout = Layout::findOrFail($id);
        LayoutBlocks::updateBlocks($layout, $request);

        $layout->update([
            "name" => $request->get('name'),
        ]);

        return redirect(route('admin.pages.layouts.index'))->with('crud', __('admin/messages.layouts.update.success'));
    }
}
