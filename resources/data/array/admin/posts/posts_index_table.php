<?php
    $table['headers'] = [' ' => 'thumbnail', __('admin/posts.name') => 'name', __('admin/posts.is_active') => 'is_active', __('admin/posts.author') => 'author', __('admin/posts.created_at') => 'created_at'];
    $table['data_types'] = ['thumbnail' => 'image', 'author' => 'name', 'is_active' => 'boolean'];
    $table['actions'] = [
        'Edit' => [
            'url' => 'admin.posts.edit',
            'class' => 'success',
            'access' => 'POST_EDIT'
        ],
        'Delete' => [
            'url' => 'admin.posts.delete',
            'class' => 'danger',
            'access' => 'POST_DELETE'
        ]
    ];
    $table['mass_edit'] = [
        "delete" => __("admin/posts.mass_delete"),
        "hide" => __("admin/posts.mass_hide"),
        "show" => __("admin/posts.mass_show"),
    ];
    $table['sort_by'] = [
        'name' => 'Title',
        'user_id' => 'Author',
        'created_at' => 'Creation date'
    ];

    return $table;