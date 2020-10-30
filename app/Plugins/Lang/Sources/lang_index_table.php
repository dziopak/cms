<?php

$table['headers'] = ['Language name' => 'name', 'Origin name' => 'origin_name', 'Lang tag' => 'lang_tag'];
$table['actions'] = [
    'Edit' => [
        'url' => 'Lang::edit',
        'class' => 'success',
        'access' => 'MODULE_USE'
    ],
    'Delete' => [
        'url' => 'Lang::delete',
        'class' => 'danger',
        'access' => 'MODULE_USE'
    ]
];

return $table;
