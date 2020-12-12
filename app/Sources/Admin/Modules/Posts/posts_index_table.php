<?php
$table['headers'] = [' ' => 'thumbnail', __('admin/posts.name') => 'name', __('admin/posts.is_active') => 'is_active', __('admin/posts.author') => 'author', __('admin/posts.created_at') => 'created_at'];
$table['data_types'] = ['thumbnail' => 'image', 'author' => 'name', 'is_active' => 'boolean'];
$table['actions'] = [
    'Edit' => [
        'url' => 'admin.posts.edit',
        'class' => 'success',
        'access' => 'POST_EDIT'
    ],
    'Delete' => [
        'url' => 'admin.posts.destroy',
        'class' => 'danger',
        'access' => 'POST_DELETE',
        'modal' => 'delete-post-modal'
    ]
];
$table['mass_edit'] = [
    "delete" => __("admin/posts.mass_delete"),
    "hide" => __("admin/posts.mass_hide"),
    "show" => __("admin/posts.mass_show"),
];
$table['mass_edit_extend'] = [
    "name_replace" => __("admin/general.mass_name_replace"),
    "category" => __("admin/general.mass_set_category")
];
$table['sort_by'] = [
    'name' => 'Title',
    'user_id' => 'Author',
    'created_at' => 'Creation date'
];

return Hook::filter('post.sources.table', $table);
