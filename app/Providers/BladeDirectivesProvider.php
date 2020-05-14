<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Helpers\ThemeHelpers;
use Blade;
use Str;

class BladeDirectivesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function registerBladeDirectives()
    {
        // Theme data
        $theme = (new ThemeHelpers);
        $theme->data = $theme->getThemeData();


        // Start wrapper
        Blade::directive('wrapper', function ($pass_params) {
            $pass_params = explode(', ', $pass_params);
            foreach ($pass_params as $key => $row) {
                $pass_params[$key] = substr($row, 1, -1);

                $tmp = explode(' => ', str_replace("'", "", $pass_params[$key]));
                if (count($tmp) > 1) {
                    $params[$tmp['0']] = $tmp['1'];
                } else {
                    $params = $tmp;
                }
            }

            $s = '<?php $this->wrappers[] = ["' . $pass_params[0] . '", "' . str_replace('"', '\"', serialize($pass_params)) . '", "' . str_replace('"', '\"', serialize($params)) . '"]; ?>';
            $s .= "<?php ob_start(); ?>";

            return $s;
        });


        // End wrapper
        Blade::directive('endwrapper', function ($value) {
            $s = "<?php \$child = ob_get_clean();";
            $s .= "\$pass_params_array = array_pop(\$this->wrappers); ?>";
            $s .= "<?php \$params = unserialize(\$pass_params_array[2]); ?>";
            $s .= "<?php \$name = \$pass_params_array[0]; ?>";
            $s .= '<?php unset($pass_params_array[0]); ?>';
            $s .= "<?php \$pass_params = unserialize(\$pass_params_array[1]); ?>";
            $s .= "<?php \$contents = \$__env->make(\$name, Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>";
            $s .= "<?php foreach(\$pass_params as \$param) { \$res = explode(' => ', str_replace('\'', '', \$param)); if (is_array(\$res) && count(\$res) > 1) { \$contents = preg_replace('/@'.\$res[0].'/', \$res[1], \$contents); } } ?>";
            $s .= "<?php echo preg_replace('/@child/', \$child, \$contents); ?>";

            return $s;
        });


        // Include current theme view
        \Blade::directive('view', function ($view) {
            $theme = new ThemeHelpers;
            return View::make($theme->getThemeView($view, [], true))->render();
        });


        // Head partial directive
        Blade::include('themes.' . $theme->data->slug . '.partials.head', 'head');


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

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerBladeDirectives();
    }
}
