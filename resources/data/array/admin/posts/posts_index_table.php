<?php
    $table['headers'] = [' ' => 'thumbnail', 'Title' => 'name', 'Visible' => 'is_active', 'Author' => 'author', 'Created at' => 'created_at'];
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
        "delete" => "Delete selected",
        "hide" => "Disable / Hide",
        "show" => "Enable / Show",
    ];
    $table['sort_by'] = [
        'name' => 'Title',
        'user_id' => 'Author',
        'created_at' => 'Creation date'
    ];

    return $table;