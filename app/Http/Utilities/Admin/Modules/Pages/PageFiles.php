<?php

namespace App\Http\Utilities\Admin\Modules\Pages;

use App\Entities\Page;
use Auth;

class PageFiles
{
    protected $pages;

    public function __construct($pages)
    {
        $this->pages = $pages;
    }

    public function updateThumbnail($file_id)
    {
        $pages = Page::findOrFail($this->pages);
        foreach ($pages as $page) {
            $page->fire_events = false;
            if ($file_id === 0) {
                $page->update(['file_id' => null]);
                $path = 'assets/no-thumbnail.png';
            } else {
                $page->update(['file_id' => $file_id]);
                $path = \App\Entities\File::select('path')->findOrFail($file_id)->path;
            }
        }

        return response()->json([
            'message' => __('admin/messages.pages.update.thumbnail.success'),
            'file' => $file_id,
            'path' => $path
        ]);
    }
}
