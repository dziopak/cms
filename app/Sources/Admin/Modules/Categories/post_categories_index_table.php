<?php

$table['headers'] = [__('admin/post_categories.name') => 'name'];
$table['actions'] = [
    'Edit' => [
        'url' => 'admin.posts.categories.edit',
        'class' => 'success',
        'access' => 'CATEGORY_EDIT'
    ],
    'Delete' => [
        'url' => 'admin.posts.categories.destroy',
        'class' => 'danger',
        'access' => 'CATEGORY_DELETE',
        'modal' => 'delete-category-modal'
    ]
];
$table['mass_edit'] = [
    'delete' => __('admin/post_categories.mass_delete')
];
$table['mass_edit_extend'] = [
    "name_replace" => __("admin/general.mass_name_replace"),
    "category" => __("admin/general.mass_set_category")
];
$table['sort_by'] = [
    'name' => __('admin/post_categories.name')
];

return $table;
