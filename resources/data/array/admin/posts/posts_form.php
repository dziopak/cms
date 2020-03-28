<?php
    $form = [
        'left' => [
            'name_row' => [
                'class' => 'form-group row',
                'items' => [
                    'name' => [
                        'type' => 'text',
                        'label' => __('admin/posts.name'),
                        'required' => true,
                        'value' => null,
                        'class' => '',
                        'container_class' => 'tinymce',
                    ],
                ],
            ],
            'slug_category_row' => [
                'class' => 'form-group row',
                'items' => [
                    'slug' => [
                        'type' => 'text',
                        'label' => __('admin/posts.slug'),
                        'required' => true,
                        'value' => null,
                        'class' => '',
                        'container_class' => 'tinymce',
                    ],
                    'category_id' => [
                        'type' => 'select',
                        'options' => $args['categories'],
                        'label' => __('admin/posts.category'),
                        'required' => true,
                        'value' => null,
                        'class' => '',
                        'container_class' => 'tinymce',
                    ],
                ],
            ],
            'excerpt_row' => [
                'class' => 'form-group row',
                'items' => [
                    'excerpt' => [
                        'type' => 'textarea',
                        'label' => __('admin/posts.excerpt'),
                        'required' => true,
                        'value' => null,
                        'class' => '',
                        'container_class' => 'tinymce',
                    ],
                ]
            ]    
        ],
        'right' => [
            'thumbnail_row' => [
                'class' => 'form-group row',
                'items' => [
                    'thumbnail' => [
                        'type' => 'file',
                        'label' => __('admin/posts.thumbnail'),
                        'class' => '',
                        'container_class' => 'tinymce',
                    ],
                ],
            ],
            'meta_title_row' => [
                'class' => 'form-group row',
                'items' => [
                    'meta_title' => [
                        'type' => 'text',
                        'label' => __('admin/posts.meta_title'),
                        'required' => false,
                        'value' => null,
                        'class' => '',
                        'container_class' => 'tinymce',
                    ],
                ]
            ],
            'meta_description_row' => [
                'class' => 'form-group row',
                'items' => [
                    'meta_description' => [
                        'type' => 'textarea',
                        'label' => __('admin/posts.meta_description'),
                        'required' => false,
                        'value' => null,
                        'class' => '',
                        'container_class' => 'tinymce',
                    ],
                ]
            ],
        ],
        'bottom' => [
            'content_row' => [
                'class' => 'form-group row',
                'items' => [
                    'content' => [
                        'type' => 'textarea',
                        'class' => 'tinymce',
                        'container_class' => 'tinymce',
                        'label' => __('admin/posts.content'),
                        'value' => null,
                        'required' => true
                    ]
                ]
            ]
        ]
    ];

    $form = Hook::get('postsFormFields',[$form],function($form){
        return $form;
    });

    return $form;