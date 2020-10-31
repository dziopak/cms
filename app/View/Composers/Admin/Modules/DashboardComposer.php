<?php

namespace App\View\Composers\Admin\Modules;

class DashboardComposer
{
    public function compose($view)
    {

        if (!$view->dashboard) {
            $view->dashboard = \App\Entities\Dashboard::create(['user_id' => $view->user->id]);
        }
        $view->with('widgets', unserialize($view->dashboard->widgets));
    }
}
