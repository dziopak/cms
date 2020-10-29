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

        // Buttons
        'create-button' => \App\View\Components\Admin\Buttons\Create::class,
        'update-button' => \App\View\Components\Admin\Buttons\Update::class,

        // Forms
        'form-fields' => \App\View\Components\Admin\Forms\Fields::class,
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


        // Include current theme view
        \Blade::directive('view', function ($view) {
            $theme = new ThemeHelpers;
            return View::make($theme->getThemeView($view, [], true))->render();
        });


        // Head partial directive
        Blade::include('themes.' . $theme->data->slug . '.partials.head', 'head');
        Blade::include('themes.' . $theme->data->slug . '.partials.meta', 'meta');


        // Grid partial directive
        Blade::include('themes.' . $theme->data->slug . '.partials.grid', 'boot');


        // Display block directive
        Blade::directive('block', function ($expression) {
            $name = explode(',', $expression)[0];
            $block = str_replace($name . ', ', "", $expression);

            return "<?php
                    \$block = unserialize($block);
                    echo Widget::run('Blocks.' . $name, ['block' => \$block, 'position' => ['x' => \$block->x, 'y' => \$block->y, 'w' => \$block->width, 'h' => \$block->height]]);
                ?>";
        });


        Blade::directive('pluginAsset', function ($expression) {
            list($type, $name, $plugin) = explode(',', $expression, 3);

            $type = trim(str_replace('\'', '', $type));
            $name = trim(str_replace('\'', '', $name));
            $plugin = trim(str_replace('\'', '', $plugin));

            $path = $type . '/plugins/' . $plugin . '/' . $name . '.' . $type;

            switch ($type) {
                case 'css':
                    return '<?php echo "<link rel="stylesheet" type="text/css" href=\'/' . $path . '\'>"; ?>';
                    break;

                case 'js':
                    return '<?php echo "<script src=\'/' . $path . '\'></script>"; ?>';
                    break;
            }
        });


        // Set variable directive
        Blade::directive('set', function ($expression) {
            list($variable, $value) = explode(',', $expression, 2);

            // Ensure variable has no spaces or apostrophes
            $variable = trim(str_replace('\'', '', $variable));
            $value = trim($value);

            return "<?php {$variable} = {$value}; ?>";
        });


        // Include JS directive
        Blade::directive('includeJS', function ($js) {
            return "<script src='{{asset(\"js/$js\")}}'></script>";
        });


        // Include CSS directive
        Blade::directive('includeCSS', function ($css) {
            return "<link  href='{{asset(\"css/$css\")}}' rel='stylesheet'>";
        });
    }


    public function boot()
    {
        $this->registerBladeDirectives();
        $this->registerComponents();
    }
}
