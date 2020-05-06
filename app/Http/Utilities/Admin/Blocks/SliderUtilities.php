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

        return response()->json(['message' => 'Slides attached successfully', 'slides' => $data, 'files' => $files], 200);
    }

    public static function detach($id, $data)
    {
        \App\Slider::findOrFail($id)->files()->detach($data);
        return response()->json(['status' => 200, 'message' => 'Slides detached successfully.', 'slides' => $data], 200);
    }
}
