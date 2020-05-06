<?php
$table['headers'] = [__('admin/blocks/sliders.name')  => 'name'];
$table['actions'] = [
    'Edit' => [
        'url' => 'admin.blocks.sliders.edit',
        'class' => 'success',
        'access' => 'FILE_EDIT'
    ],
    'Delete' => [
        'url' => 'admin.blocks.sliders.destroy',
        'class' => 'danger',
        'access' => 'MEDIA_DELETE',
        'modal' => 'delete-slider-modal'
    ]
];
$table['mass_edit'] = [
    "delete" => __('admin/blocks/sliders.mass_delete')
];
$table['sort_by'] = [
    'name' => __('admin/blocks/sliders.name'),
];

return $table;
