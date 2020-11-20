<?php

namespace App\Http\Utilities\Admin\Blocks\Carousels;

use App\Entities\Carousel;
use App\Entities\File;
use Auth;

class CarouselItems
{
    protected $carousel;


    public function __construct($carousel)
    {
        is_numeric($carousel) ? $this->carousel = Carousel::with('files')->findOrFail($carousel) : $this->carousel = $carousel;
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
        $this->carousel->files()->sync($data, false);
        Carousel::with('files')->flushQueryCache();
        File::flushQueryCache();

        return $this->carousel = $this->carousel->fresh(['files']);
    }


    public function attach($data)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');

        File::flushQueryCache();

        $this->sync($data);
        $newFiles = $this->attachedToArray($this->carousel->files, $data);

        return response()->json([
            'message' => __('admin/messages.blocks.carousels.items.attach'),
            'slides' => $data,
            'files' => $newFiles
        ], 200);
    }


    public function detach($data)
    {
        Auth::user()->hasAccessOrRedirect('BLOCK_EDIT');

        $this->carousel->files()->flushQueryCache();
        $this->carousel->files()->detach($data);

        return response()->json(['status' => 200, 'message' => __('admin/messages.blocks.carousels.items.detach'), 'slides' => $data], 200);
    }
}
