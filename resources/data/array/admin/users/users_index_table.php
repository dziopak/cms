<?php
    $table['headers'] = [' ' => 'photo', 'Email' => 'email', 'Active' => 'is_active', 'Role' => 'role', 'Created' => 'created_at'];
    $table['data_types'] = ['photo' => 'image', 'is_active' => 'boolean', 'created_at' => 'date', 'role' => 'name'];
    $table['actions'] = [
        'Edit' => [
            'url' => 'admin.users.edit',
            'class' => 'success',
            'access' => 'USER_EDIT'
        ],
        'Status' => [
            'url' => 'admin.users.disable',
            'class' => 'primary',
            'access' => 'USER_EDIT'
        ],
        'Delete' => [
            'url' => 'admin.users.delete',
            'class' => 'danger',
            'access' => 'USER_DELETE'
        ]
    ];
    $table['mass_edit'] = [
        "delete" => "Delete selected",
        "hide" => "Disable / Hide",
        "show" => "Enable / Show",
        "role" => "Set role",
    ];
    $table['mass_edit_extend'] = 'users';
    $table['sort_by'] = [
        'email' => 'Email',
        'name' => 'Username',
        'first_name' => 'First name',
        'last_name' => 'Last name',
    ];

    $table['headers'] = Hook::get('UsersIndexTableHeaders',[$table['headers']],function($table_headers){
        return $table['headers'];
    });

    return $table;