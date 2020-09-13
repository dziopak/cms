<?php

namespace Plugins\Portfolio\Providers;

use App\Http\Utilities\Admin\PluginUtilities;
use Illuminate\Support\ServiceProvider;
use Lang;
use Hook;

class HooksServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Sidebar hook
        Hook::listen('adminSidebarItems', function ($callback, $output, $items) {
            if (empty($output)) $output = $items;
            $output = array_push_after('media', [
                'portfolio' => [
                    'class' => 'icon fa fas fa-briefcase',
                    'route' => 'admin.plugins.portfolio.index',
                    'items' => [
                        'list' => [
                            'route' => 'admin.plugins.portfolio.index',
                            'custom_label' => Lang::get('portfolio::langs.list_items'),
                        ],

                        'create' => [
                            'route' => 'admin.plugins.portfolio.create',
                            'custom_label' => Lang::get('portfolio::langs.create_item')
                        ],

                        'categories' => [
                            'route' => 'admin.plugins.portfolio.categories.index',
                            'custom_label' => 'admin/routes.categories'
                        ],
                    ]
                ]
            ], $output);
            return $output;
        }, PluginUtilities::getID('portfolio'));
    }
}
