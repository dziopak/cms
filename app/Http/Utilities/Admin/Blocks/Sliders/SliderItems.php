<?php

namespace App\Http\Utilities\Admin\Blocks\Sliders;

use App\Entities\Slider;
use App\Entities\File;
use Auth;

class SliderItems
{
    protected $slider;


    public function __construct($slider)
    {
        is_numeric($slider) ? $this->slider = Slider::with('files')->findOrFail($slider) : $this->slider = $slider;
    }


    private function attachedToArray($files, $data)
    {
        $res = [];
        foreach ($files as $image) {
            if (in_array($image->id, $data)) {
                $res[] = $image;
            }
        }

        return $res;
    }


    private function sync($data)
    {
        $this->slider->files()->sync($data, false);
        $this->slider->files()->flushQueryCache();

        return $this->slider = $this->slider->fresh(['files']);
    }


    public function attach($data)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');

        File::flushQueryCache();

        $this->sync($data);
        $newFiles = $this->attachedToArray($this->slider->files, $data);

        return response()->json([
            'message' => __('admin/messages.blocks.sliders.items.attach'),
            'slides' => $data,
            'files' => $newFiles
        ], 200);
    }


    public function detach($data)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');

        $this->slider->files()->flushQueryCache();
        $this->slider->files()->detach($data);

        return response()->json(['status' => 200, 'message' => __('admin/messages.blocks.sliders.items.detach'), 'slides' => $data], 200);
    }
}
