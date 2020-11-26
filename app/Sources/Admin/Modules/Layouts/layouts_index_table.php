<?php

$table['headers'] = [__('admin/layouts.name') => 'name'];
$table['data_types'] = [
    'type' => 'switch'
];
$table['options'] = [
    'type' => [
        0 => 'Full width',
        1 => 'Left sidebar',
        2 => 'Right sidebar',
        3 => 'Both sidebars'
    ]
];
$table['actions'] = [
    'Edit' => [
        'url' => 'admin.pages.layouts.edit',
        'class' => 'success',
        'access' => 'LAYOUT_EDIT'
    ],
    'Delete' => [
        'url' => 'admin.pages.layouts.destroy',
        'class' => 'danger',
        'access' => 'LAYOUT_DELETE',
        'modal' => 'delete-layout-modal'
    ]
];
$table['mass_edit'] = [
    'delete' => __('admin/layouts.mass_delete')
];
$table['mass_edit_extend'] = [
    "name_replace" => __("admin/general.mass_name_replace"),
];
$table['sort_by'] = [
    'name' => __('admin/layouts.name')
];
return Eventy::filter('layout.sources.table', $table);
