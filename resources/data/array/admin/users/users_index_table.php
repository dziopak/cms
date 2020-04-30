<?php
$table['headers'] = [' ' => 'photo', __('admin/users.email') => 'email', __('admin/users.is_active') => 'is_active', __('admin/users.role') => 'role', __('admin/users.created_at') => 'created_at'];
$table['data_types'] = ['photo' => 'image', 'is_active' => 'boolean', 'created_at' => 'date', 'role' => 'name'];
$table['actions'] = [
    'Edit' => [
        'url' => 'admin.users.edit',
        'class' => 'success',
        'access' => 'USER_EDIT'
    ],
    'Disable' => [
        'url' => 'admin.users.disable',
        'class' => 'warning',
        'access' => 'USER_EDIT'
    ],
    'Delete' => [
        'url' => 'admin.users.delete',
        'class' => 'danger',
        'access' => 'USER_DELETE'
    ]
];
$table['mass_edit'] = [
    "delete" => __('admin/users.mass_delete'),
    "hide" => __('admin/users.mass_hide'),
    "show" => __('admin/users.mass_show'),
    "role" => __('admin/users.mass_role'),
];
$table['mass_edit_extend'] = 'users';
$table['sort_by'] = [
    'email' => __('admin/users.email'),
    'name' => __('admin/users.name'),
    'created_at' => __('admin/users.creation_date')
];

return $table;
