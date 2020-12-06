<?php

namespace App\Http\Utilities\Api\v1\Pages;

use App\Entities\User;
use App\Entities\Page;
use App\Http\Utilities\Api\Files\FileHandling;
use Illuminate\Support\Facades\DB;


class PageActions
{
    static function create($items)
    {

        DB::beginTransaction();
        $result = [];

        try {
            foreach ($items as $item) {
                $result[] = Page::create(self::prepareToStore($item));
            }
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }


    static function prepareToStore($item)
    {
        $user = User::find(User::jwtUser()->id);
        $item['user_id'] = $user->id;
        $item['slug'] = generateSlug($item['name']);

        if (!empty($item['thumbnail'])) {
            $item['file_id'] = FileHandling::fromBlob($item['thumbnail']);
            unset($item['thumbnail']);
        }

        return $item;
    }


    static function prepareToUpdate($item)
    {
        if (!empty($item['name'])) $item['slug'] = generateSlug($item['name']);
        if (!empty($item['thumbnail'])) {
            $item['file_id'] = FileHandling::fromBlob($item['thumbnail']);
            unset($item['thumbnail']);
        }
        return $item;
    }


    static function massUpdate($data, $items)
    {
        // Validate
        $valid = PageValidation::validate([$data], 'update', 'PAGE_EDIT');
        if ($valid !== true) return $valid;

        // Update
        $update = $items->update(self::prepareToUpdate($data));
        if ($update === false) return 'Failed to update.';

        return true;
    }


    static function bulkUpdate($data)
    {
        $valid = PageValidation::validate($data, 'update', 'PAGE_EDIT');
        if ($valid !== true) return $valid;

        DB::beginTransaction();
        $result = [];
        try {
            foreach ($data as $item) {
                $page = Page::dontCache()->findBySlug($item['id'] ?? $item['slug']);
                $item = self::prepareToUpdate($item);
                $page->update($item);
                $result[] = $page->fresh();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return 'Unknown error occured while updating records.';
        }

        return true;
    }
}
