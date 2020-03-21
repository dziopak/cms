<?php
    $table['headers'] = [' ' => 'thumbnail', 'Title' => 'name', 'Author' => 'author', 'Created at' => 'created_at'];
    $table['data_types'] = ['thumbnail' => 'image', 'author' => 'name'];
    $table['actions'] = [
        'Edit' => [
            'url' => 'admin.pages.edit',
            'class' => 'success',
            'access' => 'PAGE_EDIT'
        ],
        'Delete' => [
            'url' => 'admin.pages.delete',
            'class' => 'danger',
            'access' => 'PAGE_DELETE'
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