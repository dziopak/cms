<?php

namespace App\Traits;

use App\Entities\File;

trait ThumbnailService
{
    public function updateThumbnail($page_id, $file_id)
    {
        $page = $this->repository->find($page_id);
        $page->fire_events = false;

        $update = $page->update(['file_id' => $file_id]);
        if (!$update) return false;

        return response()->json([
            'message' => __('admin/messages.pages.update.thumbnail.success'),
            'file' => $file_id,
            'path' => File::select('path')->find($file_id)->path ?? 'assets/no-thumbnail.png',
            'status' => 200
        ], 200);
    }
}
