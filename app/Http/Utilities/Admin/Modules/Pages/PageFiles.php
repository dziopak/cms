<?php

namespace App\Http\Utilities\Admin\Modules\Pages;

use App\Page;
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
            $page->update(['file_id' => $file_id]);
            if ($file_id === 0) {
                $path = 'assets/no-thumbnail.png';
            } else {
                $path = \App\File::select('path')->findOrFail($file_id)->path;
            }
        }

        return response()->json([
            'message' => __('admin/messages.pages.update.thumbnail.success'),
            'file' => $file_id,
            'path' => $path
        ]);
    }
}
