<?php

namespace App\Http\Utilities\Api\v1\Categories;

use App\Entities\User;
use App\Entities\Category;
use App\Exceptions\TransactionException;
use App\Http\Utilities\Api\Files\FileHandling;
use Illuminate\Support\Facades\DB;


class CategoryActions
{
    static function create($items)
    {
        DB::beginTransaction();
        $result = [];
        try {
            foreach ($items as $item) {
                $result[] = Category::create(self::prepareToStore($item));
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new TransactionException('Unknowned error occured during category creating transaction.');
        }
        return $result ?? false;
    }
}
