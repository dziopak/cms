<?php

namespace App\Http\Utilities\Admin\Blocks;

class SliderUtilities
{
    public static function attach($id, $data)
    {

        $slider = \App\Slider::findOrFail($id)->files()->sync($data, false);
        $slider = \App\Slider::with('files')->findOrFail($id);

        $files = [];
        foreach ($slider->files as $image) {
            if (in_array($image->id, $data)) {
                $files[] = $image;
            }
        }

        return response()->json(['message' => __('admin/messages.blocks.sliders.items.attach'), 'slides' => $data, 'files' => $files], 200);
    }

    public static function detach($id, $data)
    {
        \App\Slider::findOrFail($id)->files()->detach($data);
        return response()->json(['status' => 200, 'message' => __('admin/messages.blocks.sliders.items.detach'), 'slides' => $data], 200);
    }

    public static function mass($data)
    {
        if (empty($data['mass_edit'])) {
            return redirect()->back();
        } else {
            switch ($data['mass_action']) {
                case 'delete':
                    return SliderUtilities::mass_delete($data['mass_edit']);
                    break;
            }
        }
    }

    public static function mass_delete($ids)
    {
        \Auth::user()->hasAccessOrRedirect('BLOCK_DELETE');

        \App\Slider::whereIn('id', $ids)->delete();
        return redirect(route('admin.blocks.sliders.index'))->with(['crud' => __('admin/messages.blocks.sliders.mass.delete')]);
    }
}
