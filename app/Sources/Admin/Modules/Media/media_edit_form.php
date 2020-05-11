<?php

$form = [
    'basic' => [
        'name_row' => [
            'class' => 'form-group row',
            'items' => [
                'name' => [
                    'type' => 'text',
                    'label' => __('admin/media.name'),
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => ''
                ],
            ],
        ],

        'description_row' => [
            'class' => 'form-group row',
            'items' => [
                'description' => [
                    'type' => 'text',
                    'label' => __('admin/media.description'),
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => ''
                ],
            ]
        ]
    ],
];

$form = Hook::get('mediaEditFormFields', [$form], function ($form) {
    return $form;
});

return $form;
