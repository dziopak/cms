<?php
$table['headers'] = [' ' => 'path', __('admin/media.name')  => 'name', __('admin/media.type') => 'type', __('admin/media.created_at') => 'created_at'];
$table['data_types'] = ['path' => 'image_local'];
$table['actions'] = [
    'Edit' => [
        'url' => 'admin.media.edit',
        'class' => 'success',
        'access' => 'FILE_EDIT'
    ],
    'Delete' => [
        'url' => 'admin.media.destroy',
        'class' => 'danger',
        'access' => 'FILE_DELETE',
        'modal' => 'delete-media-modal'
    ]
];
$table['mass_edit'] = [
    "delete" => __('admin/media.mass_delete')
];
$table['sort_by'] = [
    'type' => __('admin/media.type'),
    'created_at' => __('admin/media.creation_date'),
    'name' => __('admin/media.name'),
];

return $table;
