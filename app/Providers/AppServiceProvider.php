<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('wrapper', function($params) {
            $params = explode(', ', $params);
            foreach($params as $key => $row) {
                $params[$key] = substr($row, 1, -1);
            }
            
            $s = '<?php $this->wrappers[] = ["'.$params[0].'", "'.str_replace('"', '\"', serialize($params)).'"]; ?>';
            $s .= "<?php ob_start(); ?>";

            return $s;
        });
        
        Blade::directive('endwrapper', function($value) {
            $s = "<?php \$child = ob_get_clean();";
            $s .= "\$params_array = array_pop(\$this->wrappers); ?>";
            $s .= "<?php \$name = \$params_array[0]; ?>";
            $s .= '<?php unset($params_array[0]); ?>';
            $s .= "<?php \$params = unserialize(\$params_array[1]); ?>";
            $s .= "<?php \$contents = \$__env->make(\$name, Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>";
            $s .= "<?php foreach(\$params as \$param) { \$res = explode(' => ', str_replace('\'', '', \$param)); if (is_array(\$res) && count(\$res) > 1) { \$contents = preg_replace('/@'.\$res[0].'/', \$res[1], \$contents); } } ?>";
            $s .= "<?php echo preg_replace('/@child/', \$child, \$contents); ?>";
        
            return $s;
        });
    }
}
