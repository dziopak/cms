<?php
$table = [
    'headers' => [
        '' => 'thumbnail',
        __('admin/general.name') => 'name',
        __('admin/general.slug') => 'slug',
    ],

    'data_types' => [
        'thumbnail' => 'image',
        'created_at' => 'date'
    ],

    'actions' => [
        'Edit' => [
            'url' => 'admin.plugins.portfolio.edit',
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
        'created_at' => 'Creation date',
    ]
];

return $table;
