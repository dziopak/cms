<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Helpers\ThemeHelpers;
use Blade;

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

        \Blade::directive('view', function ($view) {
            $theme = new ThemeHelpers;
            return View::make($theme->getThemeView($view, [], true))->render();
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
