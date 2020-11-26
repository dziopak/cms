<?php

$table['headers'] = [' ' => 'thumbnail', __('admin/pages.name') => 'name', __('admin/pages.author') => 'author', __('admin/pages.created_at') => 'created_at'];
$table['data_types'] = ['thumbnail' => 'image', 'author' => 'name'];
$table['actions'] = [
    'Edit' => [
        'url' => 'admin.pages.edit',
        'class' => 'success',
        'access' => 'PAGE_EDIT'
    ],
    'Delete' => [
        'url' => 'admin.pages.destroy',
        'class' => 'danger',
        'access' => 'PAGE_DELETE',
        'modal' => 'delete-page-modal'
    ]
];
$table['mass_edit'] = [
    "delete" => __('admin/pages.mass_delete'),
    "hide" => __('admin/pages.mass_hide'),
    "show" => __('admin/pages.mass_show'),
];
$table['mass_edit_extend'] = [
    "name_replace" => __("admin/general.mass_name_replace"),
    "category" => __("admin/general.mass_set_category")
];
$table['sort_by'] = [
    'name' => __('admin/pages.name'),
    'user_id' => __('admin/pages.author'),
    'created_at' => __('admin/pages.creation_date'),
];

return Eventy::filter('page.sources.table', $table);
