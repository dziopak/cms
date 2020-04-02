<?php
    $table = [
        'headers' => [
            '' => 'thumbnail',
            'Name' => 'name',
            'slug' => 'slug',
            'Created' => 'created_at'
        ],

        'data_types' => [
            'thumbnail' => 'image',
            'created_at' => 'date'
        ],

        'actions' => [
            'Edit' => [
                'url' => 'admin.modules.portfolio.edit',
                'class' => 'success',
                'access' => 'MODULE_USE'
            ],
            'Delete' => [
                'url' => 'admin.modules.portfolio.delete',
                'class' => 'danger',
                'access' => 'MODULE_USE'
            ]
        ],
        
        'mass_edit' => [
            'delete' => 'Delete selected'
        ],

        'sort_by' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'created_at' => 'Creation date',
        ]
    ];

    return $table;