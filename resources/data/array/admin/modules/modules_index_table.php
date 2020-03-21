<?php
    $table['headers'] = ['Module name' => 'name', 'Description' => 'description'];
    $table['data_types'] = ['active' => 'boolean'];
    $table['actions'] = [
        'Control panel' => [
            'url' => 'admin.modules.{module_slug}.index',
            'class' => 'success',
            'access' => 'MODULE_USE',
        ],
        'Settings' => [
            'url' => 'admin.modules.{module_slug}.index',
            'class' => 'primary',
            'access' => 'MODULE_EDIT'
        ],
        'Disable' => [
            'url' => 'admin.modules.{module_slug}.index',
            'class' => 'warning',
            'access' => 'MODULE_EDIT'
        ],
        'Delete' => [
            'url' => 'admin.modules.{module_slug}.index',
            'class' => 'danger',
            'access' => 'MODULE_EDIT'
        ],
    ];

    return $table;