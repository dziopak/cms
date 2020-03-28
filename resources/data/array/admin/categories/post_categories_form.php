<?php
    $form = [
        'left' => [
            'name_row' => [
                'class' => 'form-group row',
                'items' => [
                    'name' => [
                        'type' => 'text',
                        'label' => __('admin/post_categories.name'),
                        'required' => true,
                        'value' => null,
                        'class' => '',
                        'container_class' => ''
                    ],
                ],
            ],
            'slug_category_row' => [
                'class' => 'form-group row',
                'items' => [
                    'slug' => [
                        'type' => 'text',
                        'label' => __('admin/post_categories.slug'),
                        'required' => true,
                        'value' => null,
                        'class' => '',
                        'container_class' => ''
                    ],
                    'parent_id' => [
                        'type' => 'select',
                        'options' => $args['categories'],
                        'label' => __('admin/post_categories.parent'),
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
                        'type' => 'textarea',
                        'label' => __('admin/post_categories.description'),
                        'required' => true,
                        'value' => null,
                        'class' => '',
                        'container_class' => ''
                    ],
                ]
            ]    
        ],
    ];

    $form = Hook::get('postCategoriesFormFields',[$form],function($form){
        return $form;
    });

    return $form;