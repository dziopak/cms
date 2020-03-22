<?php
    $form = [
        'left' => [
            [
                'class' => 'form-group row',
                'items' => [
                    'name' => [
                        'type' => 'text',
                        'label' => __('admin/page_categories.name'),
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
                        'label' => __('admin/page_categories.slug'),
                        'required' => true,
                        'value' => null,
                        'class' => ''
                    ],
                    'parent_id' => [
                        'type' => 'select',
                        'options' => $args['categories'],
                        'label' => __('admin/page_categories.parent'),
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
                        'label' => __('admin/page_categories.description'),
                        'required' => true,
                        'value' => null,
                        'class' => ''
                    ],
                ]
            ]    
        ],
    ];

    return $form;