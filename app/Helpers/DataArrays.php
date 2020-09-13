<?php

function getData($file)
{
    if (!empty(func_get_args()[1])) $args = func_get_args()[1];
    return include(base_path('app/Sources/' . $file . '.php'));
}

function getModuleData($file, $module_name)
{
    if (!empty(func_get_args()[2])) $args = func_get_args()[2];
    return include(base_path('plugins/' . $module_name . '/Sources/' . $file . '.php'));
};

function addFormInput($name, $type, $label, $required = false, $value = null, $class = '', $container_class = '', $attributes = [], $container_attributes = [])
{
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

function parseAttributes($item, $field)
{
    $res = '';
    if (!empty($item[$field])) {
        foreach ($item[$field] as $key => $row) {
            $res .= $key . '=' . $row . ' ';
        }
    }
}

function getThumbnail($thumb, $type = 0)
{
    if (!$thumb) {
        switch ($type) {
            case 1:
                return 'images/assets/no-avatar.png';
                break;

            default:
                return 'images/assets/no-thumbnail.png';
                break;
        }
    } else {
        return 'images/' . $thumb->path;
    }
}
