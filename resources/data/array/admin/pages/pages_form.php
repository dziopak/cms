<?php
    $form = [
        'left' => [
            [
                'class' => 'form-group row',
                'items' => [
                    'name' => [
                        'type' => 'text',
                        'label' => __('admin/pages.name'),
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
                        'label' => __('admin/pages.slug'),
                        'required' => true,
                        'value' => null,
                        'class' => ''
                    ],
                    'category_id' => [
                        'type' => 'select',
                        'options' => $args['categories'],
                        'label' => __('admin/pages.category'),
                        'required' => true,
                        'value' => null,
                        'class' => ''
                    ],
                ],
            ],
            [
                'class' => 'form-group row',
                'items' => [
                    'excerpt' => [
                        'type' => 'textarea',
                        'label' => __('admin/pages.excerpt'),
                        'required' => true,
                        'value' => null,
                        'class' => ''
                    ],
                ]
            ]    
        ],
        'right' => [
            [
                'class' => 'form-group row',
                'items' => [
                    'thumbnail' => [
                        'type' => 'file',
                        'label' => __('admin/pages.thumbnail'),
                        'class' => ''
                    ],
                ],
            ],
            [
                'class' => 'form-group row',
                'items' => [
                    'meta_title' => [
                        'type' => 'text',
                        'label' => __('admin/pages.meta_title'),
                        'required' => false,
                        'value' => null,
                        'class' => ''
                    ],
                ]
            ],
            [
                'class' => 'form-group row',
                'items' => [
                    'meta_description' => [
                        'type' => 'textarea',
                        'label' => __('admin/pages.meta_description'),
                        'required' => false,
                        'value' => null,
                        'class' => ''
                    ],
                ]
            ],
            [
                'class' => 'form-group',
                'items' => [
                    'index' => [
                        'type' => 'checkbox',
                        'label' => __('admin/pages.index'),
                        'value' => null,
                        'checked_value' => 1,
                        'class' => ''
                    ],
                    'follow' => [
                        'type' => 'checkbox',
                        'label' => __('admin/pages.follow'),
                        'value' => null,
                        'checked_value' => 1,
                        'class' => ''
                    ],
                ]
            ]
        ],
        'bottom' => [
            [
                'class' => 'form-group row',
                'items' => [
                    'content' => [
                        'type' => 'textarea',
                        'class' => 'tinymce',
                        'label' => __('admin/pages.content'),
                        'value' => null,
                        'required' => true
                    ]
                ]
            ]
        ]
    ];

    return $form;