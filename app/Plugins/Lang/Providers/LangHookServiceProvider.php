<?php

namespace App\Plugins\Lang\Providers;

use Illuminate\Support\ServiceProvider;
use App\Plugins\Lang\Entities\Lang;
use Hook;

class LangHookServiceProvider extends ServiceProvider
{
    private $hooks = [
        'posts',
        'pages',
        'categories',
        'layout'
    ];

    private function registerHooks()
    {
        $this->langs = Lang::all();

        foreach ($this->hooks as $hooks) {
            require_once base_path('app/Plugins/Lang/Hooks/' . $hooks . '.php');
        }

        return $this;
    }

    public function boot()
    {
        $langs = Lang::all();
        $this->registerHooks();
    }
}
