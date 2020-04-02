<?php

    function getData($file) {
        if (!empty(func_get_args()[1])) $args = func_get_args()[1];
        return include(base_path('resources/data/array/'.$file.'.php'));
    }

    function getModuleData($file, $module_name) {
        if (!empty(func_get_args()[2])) $args = func_get_args()[2];
        return include(base_path('modules/'.$module_name.'/resources/data/array/'.$file.'.php'));
    };

    function addFormInput($name, $type, $label, $required = false, $value = null, $class = '', $container_class = '', $attributes = [], $container_attributes = []) {
        return [
            $name => [
                'type' => $type,
                'label' => __($label),
                'required' => $required,
                'value' => $value,
                'class' => $class,
                'container_class' => $container_class,
                'attributes' => $attributes,
                'container_attributes' => $container_attributes,
            ]
        ];
    }

    function parseAttributes($item, $field) {
        $res = '';
        if (!empty($item[$field])) {
            foreach($item[$field] as $key => $row) {
              $res .= $key.'='.$row.' ';
            }
        }
    }
