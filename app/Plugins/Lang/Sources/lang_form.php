<?php

$form = [
    [
        'class' => 'form-group row',
        'items' => [
            'name' => [
                'type' => 'text',
                'label' => 'Language name',
                'required' => true,
                'value' => null,
                'class' => ''
            ],
        ],
    ],
    [
        'class' => 'form-group row',
        'items' => [
            'origin_name' => [
                'type' => 'text',
                'label' => 'Origin name',
                'required' => true,
                'value' => null,
                'class' => ''
            ],
        ],
    ],
    [
        'class' => 'form-group row',
        'items' => [
            'lang_tag' => [
                'type' => 'text',
                'label' => 'Language tag',
                'required' => true,
                'value' => null,
                'class' => ''
            ],
        ],
    ],
];

return $form;
