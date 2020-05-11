<?php

$table['headers'] = [__('admin/roles.name') => 'name'];
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
        'url' => 'admin.users.roles.destroy',
        'class' => 'danger',
        'disabled' => ['0', '1'],
        'access' => 'ROLE_DELETE',
        'modal' => 'delete-role-modal'
    ],
];
$table['sort_by'] = [
    'name' => __('admin/roles.name')
];

return $table;
