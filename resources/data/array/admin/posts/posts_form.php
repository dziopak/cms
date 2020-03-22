<?php
    $form = [
        'left' => [
            [
                'class' => 'form-group row',
                'items' => [
                    'name' => [
                        'type' => 'text',
                        'label' => __('admin/posts.name'),
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
                        'label' => __('admin/posts.slug'),
                        'required' => true,
                        'value' => null,
                        'class' => ''
                    ],
                    'category_id' => [
                        'type' => 'select',
                        'options' => $args['categories'],
                        'label' => __('admin/posts.category'),
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
                        'label' => __('admin/posts.excerpt'),
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
                        'label' => __('admin/posts.thumbnail'),
                        'class' => ''
                    ],
                ],
            ],
            [
                'class' => 'form-group row',
                'items' => [
                    'meta_title' => [
                        'type' => 'text',
                        'label' => __('admin/posts.meta_title'),
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
                        'label' => __('admin/posts.meta_description'),
                        'required' => false,
                        'value' => null,
                        'class' => ''
                    ],
                ]
            ],
        ],
        'bottom' => [
            [
                'class' => 'form-group row',
                'items' => [
                    'content' => [
                        'type' => 'textarea',
                        'class' => 'tinymce',
                        'label' => __('admin/posts.content'),
                        'value' => null,
                        'required' => true
                    ]
                ]
            ]
        ]
    ];

    return $form;