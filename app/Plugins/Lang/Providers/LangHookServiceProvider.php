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
        'categories'
    ];

    private $langs = [];

    private function registerHooks()
    {
        $this->langs = Lang::all();

        foreach ($this->hooks as $hooks) {
            require base_path('app/Plugins/Lang/Hooks/' . $hooks . '.php');
        }

        return $this;
    }

    public function boot()
    {
        $langs = Lang::all();
        $this->registerHooks();


        Hook::listen('adminSidebarItems', function ($callback, $output, $items) {
            if (empty($output)) {
                $output = $items;
            }

            $output['settings']['items']['lang'] = [
                'route' => 'Lang::index',
                'custom_label' => __('Lang::messages.sidebar_title')
            ];

            return $output;
        }, 10);


        Hook::listen('template.adminStylesheets', function ($callback, $output, $variables) {
            $html = '<link href="/css/lang/lang.css" rel="stylesheet">';
            !empty($output) ? $output .= $html : $output = $html;
            return $output;
        });


        Hook::listen('template.adminScriptsDefer', function ($callback, $output, $variables) {
            $html = '<script src="/js/lang/lang.js"></script>';
            !empty($output) ? $output .= $html : $output = $html;
            return $output;
        });


        Hook::listen('template.adminInlineScripts', function ($callback, $output, $variables) use ($langs) {
            $html = '<div class="input-lang-switcher">';
            $html .= '<div class="input-lang active" style="background-image: url(\'/images/langs/flags/en.png\');" data-lang="default"></div>';
            foreach ($langs as $lang) {
                $html .= '<div style="background-image: url(\'/images/langs/flags/' . $lang->lang_tag . '.png\');" class="input-lang" data-lang="' . $lang->lang_tag . '"></div>';
            }
            $html .= '</div>';
            $script = '
                    $(document).ready(function() {
                        var fields = $(".lang_origin");

                        if (fields.length > 0) {
                            fields.each(function() {
                                $(this).append(`' . $html . '`);
                            });
                        }
                    });
                ';
            !empty($output) ? $output .= $script : $output = $script;
            return $output;
        });
    }
}
