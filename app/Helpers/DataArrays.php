<?php
    function getData($file) {
        if (!empty(func_get_args()[1])) $args = func_get_args()[1];
        return $result = include(base_path('resources/data/array/'.$file.'.php'));
    }