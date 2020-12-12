<?php
$form = [
    'left' => [
        'name_row' => [
            'class' => 'form-group row',
            'items' => [
                'name' => [
                    'type' => 'text',
                    'label' => __('admin/categories.name'),
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
                    'label' => __('admin/categories.slug'),
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => '',
                    'disabled' => true
                ],
                'category_id' => [
                    'type' => 'select',
                    'options' => $args['categories'],
                    'label' => __('admin/categories.parent'),
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
                    'label' => __('admin/categories.description'),
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => ''
                ],
            ]
        ]
    ],
];
return Hook::filter('category.sources.form', $form);
