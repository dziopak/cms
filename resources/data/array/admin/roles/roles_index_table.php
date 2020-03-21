<?php

    $table['headers'] = ['Role name' => 'name'];
    $table['actions'] = [
        'Edit' => [
            'url' => 'admin.users.roles.edit',
            'class' => 'success',
            'access' => 'ROLE_EDIT'
        ],
        'Duplicate' => [
            'url' => 'admin.users.roles.duplicate',
            'class' => 'primary',
            'access' => 'ROLE_CREATE'
        ],
        'Delete' => [
            'url' => 'admin.users.roles.delete',
            'class' => 'danger',
            'disabled' => ['0', '1'],
            'access' => 'ROLE_DELETE'
        ],
    ];
    $table['sort_by'] = [
        'name' => 'Name'
    ];

    return $table;