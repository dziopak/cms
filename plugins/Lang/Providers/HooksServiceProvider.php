<?php

namespace Plugins\Lang\Providers;

use Illuminate\Support\ServiceProvider;
use plugins\Lang\Entities\Lang;
use Hook;

class HooksServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $langs = Lang::all();

        require('Hooks/posts.hooks.php');
        require('Hooks/pages.hooks.php');
        require('Hooks/categories.hooks.php');
        require('Hooks/modules/testimonials.hooks.php');
        require('Hooks/modules/portfolio.hooks.php');


        Hook::listen('adminSidebarItems', function ($callback, $output, $items) {
            if (empty($output)) {
                $output = $items;
            }

            $output['settings']['items']['lang'] = [
                'route' => 'admin.plugins.lang.index',
                'custom_label' => __('lang::admin/langs.lang_settings')
            ];

            return $output;
        }, 10);

        Hook::listen('template.adminStylesheets', function ($callback, $output, $variables) {
            $html = '<link href="' . asset('public/css/lang.css') . '" rel="stylesheet">';
            !empty($output) ? $output .= $html : $output = $html;
            return $output;
        });

        Hook::listen('template.adminScriptsDefer', function ($callback, $output, $variables) {
            $html = '<script src="' . asset('js/langs.js') . '"></script>';
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
