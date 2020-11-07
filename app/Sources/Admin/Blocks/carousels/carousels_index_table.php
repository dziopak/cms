<?php
$table['headers'] = [__('admin/blocks/carousels.name')  => 'name'];
$table['actions'] = [
    'Edit' => [
        'url' => 'admin.blocks.carousels.edit',
        'class' => 'success',
        'access' => 'FILE_EDIT'
    ],
    'Delete' => [
        'url' => 'admin.blocks.carousels.destroy',
        'class' => 'danger',
        'access' => 'MEDIA_DELETE',
        'modal' => 'delete-carousel-modal'
    ]
];
$table['mass_edit'] = [
    "delete" => __('admin/blocks/carousels.mass_delete')
];
$table['sort_by'] = [
    'name' => __('admin/blocks/carousels.name'),
];

return $table;
