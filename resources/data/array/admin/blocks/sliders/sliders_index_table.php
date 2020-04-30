<?php
$table['headers'] = [__('admin/blocks/sliders.name')  => 'name', __('admin/blocks/sliders.count') => 'slidesCount'];
$table['actions'] = [
    'Edit' => [
        'url' => 'admin.blocks.sliders.edit',
        'class' => 'success',
        'access' => 'FILE_EDIT'
    ],
    'Delete' => [
        'url' => 'admin.blocks.sliders.delete',
        'class' => 'danger',
        'access' => 'MEDIA_DELETE'
    ]
];
$table['mass_edit'] = [
    "delete" => __('admin/blocks/sliders.mass_delete')
];
$table['sort_by'] = [
    'name' => __('admin/blocks/sliders.name'),
];

return $table;
