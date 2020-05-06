<?php

$table['headers'] = [__('admin/page_categories.name') => 'name'];
$table['actions'] = [
    'Edit' => [
        'url' => 'admin.pages.categories.edit',
        'class' => 'success',
        'access' => 'CATEGORY_EDIT'
    ],
    'Delete' => [
        'url' => 'admin.pages.categories.destroy',
        'class' => 'danger',
        'access' => 'CATEGORY_DELETE',
        'modal' => 'delete-category-modal'
    ]
];
$table['mass_edit'] = [
    'delete' => __('admin/page_categories.mass_delete')
];
$table['sort_by'] = [
    'name' => __('admin/page_categories.name')
];

return $table;
