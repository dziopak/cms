<?php

    $table['headers'] = [__('admin/post_categories.name') => 'name'];
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
        'delete' => __('admin/post_categories.mass_delete')
    ];
    $table['sort_by'] = [
        'name' => __('admin/post_categories.name')
    ];

    return $table;