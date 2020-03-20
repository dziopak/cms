<?php
    $form = [
        'left' => [
            [
                'class' => 'form-group row',
                'items' => [
                    'name' => [
                        'type' => 'text',
                        'label' => 'Category name',
                        'required' => true,
                        'value' => null,
                        'class' => ''
                    ],
                ],
            ],
            [
                'class' => 'form-group row',
                'items' => [
                    'slug' => [
                        'type' => 'text',
                        'label' => 'Slug',
                        'required' => true,
                        'value' => null,
                        'class' => ''
                    ],
                    'parent_id' => [
                        'type' => 'select',
                        'options' => $args['categories'],
                        'label' => 'Parent category',
                        'required' => true,
                        'value' => null,
                        'class' => ''
                    ],
                ],
            ],
            [
                'class' => 'form-group row',
                'items' => [
                    'description' => [
                        'type' => 'textarea',
                        'label' => 'Description',
                        'required' => true,
                        'value' => null,
                        'class' => ''
                    ],
                ]
            ]    
        ],
    ];

    return $form;