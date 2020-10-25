<?php

namespace App\Composers\Admin;

class DashboardComposer
{
    public function compose($view)
    {

        if (!$view->dashboard) {
            $view->dashboard = \App\Models\Dashboard::create(['user_id' => $view->user->id]);
        }
        $view->with('widgets', unserialize($view->dashboard->widgets));
    }
}
