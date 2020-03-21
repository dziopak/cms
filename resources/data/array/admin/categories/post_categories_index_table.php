<?php

    $table['headers'] = ['Category name' => 'name'];
    $table['actions'] = [
        'Edit' => [
            'url' => 'admin.posts.categories.edit',
            'class' => 'success',
            'access' => 'CATEGORY_EDIT'
        ],
        'Delete' => [
            'url' => 'admin.posts.categories.delete',
            'class' => 'danger',
            'access' => 'CATEGORY_DELETE'
        ]
    ];
    $table['mass_edit'] = [
        'delete' => 'Delete selected'
    ];
    $table['sort_by'] = [
        'name' => 'Name'
    ];

    return $table;