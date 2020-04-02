<?php
    namespace App\Http\Utilities;

    use Carbon\Carbon;

    class ModelUtilities {
        public static function makeDirtyRequest($field, $data) {
            !empty($field) ? $data['updated_at'] = Carbon::now()->timestamp : null;
            return $data;
        }
    }