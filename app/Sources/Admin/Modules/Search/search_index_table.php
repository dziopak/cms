<?php

$table['headers'] = [
    __('admin/posts.name') => 'title',
    'Type' => 'type',
];

$table['actions'] = [
    'edit' => [
        'iterator' => 'url',
        'url' => 'admin.dashboard.index',
        'class' => 'test'
    ]
];

$table['sort_by'] = [
    'name' => 'Title',
    'user_id' => 'Author',
    'created_at' => 'Creation date'
];

return Eventy::filter('search.sources.table', $table);
