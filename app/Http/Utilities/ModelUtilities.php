<?php

namespace App\Http\Utilities;

use Carbon\Carbon;

class ModelUtilities
{
    public static function makeDirtyRequest($field, $data)
    {
        !empty($field) ? $data['updated_at'] = Carbon::now()->timestamp : null;
        return $data;
    }

    public static function scope($model, $request)
    {
        $perpage = $request->get('perpage') ?? 15;

        if (!empty($random = $request->get('random'))) {
            return $model->get()->random($random);
        }

        if (!empty($limit = $request->get('limit'))) {
            return $model->get()->take($limit);
        }

        return $model->paginate($perpage);
    }

    public static function bySlug($slug, $model)
    {
        if (is_numeric($slug)) {
            return $item = $model->find($slug);
        }

        return $item = $model->where(['slug' => $slug])->first();
    }
}
