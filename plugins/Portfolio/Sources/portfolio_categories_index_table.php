<?php

$table = [
    'headers' => [
        __('admin/general.name') => 'name',
        __('admin/general.slug') => 'slug',
    ],

    'actions' => [
        'Edit' => [
            'url' => 'admin.plugins.portfolio.categories.edit',
            'class' => 'success',
            'access' => 'MODULE_USE'
        ],
        'Delete' => [
            'url' => 'admin.plugins.portfolio.delete',
            'class' => 'danger',
            'access' => 'MODULE_USE'
        ]
    ],

    'mass_edit' => [
        'delete' => __('admin/general.mass_delete')
    ],

    'sort_by' => [
        'name' => 'Name',
        'slug' => 'Slug',
    ]
];

return $table;
