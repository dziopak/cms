<?php

namespace App\View\Composers;

class Composer
{
    public static function bindData($data, $view)
    {
        view()->composer($view, function ($view) use ($data) {
            foreach ($data as $key => $row) {
                $view[$key] = $row;
            }
        });
    }
}
