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
return Eventy::filter('layout.sources.form', $form);
