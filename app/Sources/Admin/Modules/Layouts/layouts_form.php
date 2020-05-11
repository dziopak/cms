<?php

$form = [
    'basic_data' => [
        'name_row' => [
            'class' => 'form-group row',
            'items' => [
                'name' => [
                    'type' => 'text',
                    'label' => __('admin/layouts.name'),
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => ''
                ],
            ],
        ],
    ],
];

$form = Hook::get('layoutsFormFields', [$form], function ($form) {
    return $form;
});

return $form;
