<?php

if (!function_exists('is')) {
    function is($file, $extension)
    {
        return (pathinfo($file)['extension'] === $extension);
    }
}

if (!function_exists('copy_to')) {
    function copy_to($file, $destination)
    {
        $path = pathinfo($destination);
        if (!file_exists($path['dirname'])) {
            mkdir($path['dirname'], 0777, true);
        }
        if (!copy($file, $destination)) {
            abort(404);
        }
    }
}
