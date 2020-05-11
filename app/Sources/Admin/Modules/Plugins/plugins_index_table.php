<?php
$table['headers'] = [__('admin/plugins.name') => 'name', __('admin/plugins.description') => 'description'];
$table['data_types'] = ['active' => 'boolean'];
$table['actions'] = [
    'Control panel' => [
        'url' => 'admin.plugins.{module_slug}.index',
        'class' => 'primary',
        'access' => 'MODULE_USE',
    ],
    'Settings' => [
        'url' => 'admin.plugins.{module_slug}.index',
        'class' => 'success',
        'access' => 'MODULE_EDIT'
    ],
    'Disable' => [
        'url' => 'admin.plugins.{module_slug}.index',
        'class' => 'warning',
        'access' => 'MODULE_EDIT'
    ],
    'Delete' => [
        'url' => 'admin.plugins.{module_slug}.index',
        'class' => 'danger',
        'access' => 'MODULE_EDIT'
    ],
];

return $table;
