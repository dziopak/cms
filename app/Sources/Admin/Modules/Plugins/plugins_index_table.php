<?php
$table['active']['headers'] = [__('admin/plugins.name') => 'name', __('admin/plugins.description') => 'description'];
$table['active']['data_types'] = ['active' => 'boolean'];
$table['active']['actions'] = [
    'Control panel' => [
        'url' => 'admin.plugins.{slug}.index',
        'class' => 'success',
        'access' => 'MODULE_USE',
        'iterator' => 'slug'
    ],
    'Disable' => [
        'url' => 'admin.plugins.disable',
        'class' => 'primary',
        'access' => 'MODULE_EDIT',
        'iterator' => 'slug',
    ],
    'Delete' => [
        'url' => 'admin.plugins.{slug}.index',
        'class' => 'danger',
        'access' => 'MODULE_EDIT',
        'iterator' => 'slug'
    ],
];

$table['inactive']['headers'] = [__('admin/plugins.name') => 'name', __('admin/plugins.description') => 'description'];
$table['inactive']['data_types'] = ['active' => 'boolean'];
$table['inactive']['actions'] = [
    'Disable' => [
        'url' => 'admin.plugins.enable',
        'class' => 'success',
        'access' => 'MODULE_EDIT',
        'iterator' => 'slug'
    ],
    'Delete' => [
        'url' => 'admin.dashboard.index',
        'class' => 'danger',
        'access' => 'MODULE_EDIT',
        'iterator' => 'slug'
    ],
];

return $table;
