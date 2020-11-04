<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Helpers\ThemeHelpers;
use Blade;

class BladeDirectivesProvider extends ServiceProvider
{

    private $components = [
        // Widgets
        'widget-block' => \App\View\Components\Admin\Containers\Widgets\Block::class,
        'new-widget' => \App\View\Components\Admin\Containers\Widgets\Create::class,
        'dashboard-widget' => \App\View\Components\Admin\Containers\Widgets\Dashboard::class,

        // Wrappers
        'wrapper' => \App\View\Components\Admin\Containers\Wrappers\Wrapper::class,

        // Tables
        'table' => \App\View\Components\Admin\Tables\Table::class,
        'table-headers' => \App\View\Components\Admin\Tables\Partials\Headers::class,
        'table-fields' => \App\View\Components\Admin\Tables\Partials\Fields::class,
        'table-filters' => \App\View\Components\Admin\Tables\Partials\Filters::class,
        'table-actions' => \App\View\Components\Admin\Tables\Partials\Actions::class,
        'table-action-type' => \App\View\Components\Admin\Tables\Partials\Action::class,
        'mass-edit' => \App\View\Components\Admin\Tables\Partials\MassEdit::class,

        // Modals
        'media-upload-modal' => \App\View\Components\Admin\Modals\AddMedia::class,

        // Buttons
        'create-button' => \App\View\Components\Admin\Buttons\Create::class,
        'update-button' => \App\View\Components\Admin\Buttons\Update::class,

        // Forms
        'form-fields' => \App\View\Components\Admin\Forms\Fields::class,
        'form-validation' => \App\View\Components\Admin\Forms\Validation::class,

        // Inputs
        'image-input' => \App\View\Components\Admin\Inputs\Image::class,

        // Other
        'logs' => \App\View\Components\Admin\Logs\LogList::class,

        // Other
        'user-profile' => \App\View\Components\Admin\Other\UserProfile::class,
        'crumb' => \App\View\Components\Admin\Other\Breadcrumb::class,
    ];


    private function registerComponents()
    {
        foreach ($this->components as $alias => $component) {
            Blade::component($alias, $component);
        }
    }


    private function registerBladeDirectives()
    {
        // Theme data
        $theme = (new ThemeHelpers);
        $theme->data = $theme->getThemeData();


        // Display block directive
        Blade::directive('block', function ($expression) {
            $name = explode(',', $expression)[0];
            $block = str_replace($name . ', ', "", $expression);

            return "<?php
                    \$block = unserialize($block);
                    echo Widget::run('Blocks.' . $name, ['block' => \$block, 'position' => ['x' => \$block->x, 'y' => \$block->y, 'w' => \$block->width, 'h' => \$block->height]]);
                ?>";
        });


        // Set variable directive
        Blade::directive('set', function ($expression) {
            list($variable, $value) = explode(',', $expression, 2);

            // Ensure variable has no spaces or apostrophes
            $variable = trim(str_replace('\'', '', $variable));
            $value = trim($value);

            return "<?php {$variable} = {$value}; ?>";
        });
    }


    public function boot()
    {
        $this->registerBladeDirectives();
        $this->registerComponents();
    }
}
