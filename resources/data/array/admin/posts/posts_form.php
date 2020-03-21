<?php
    $form = [
        'left' => [
            [
                'class' => 'form-group row',
                'items' => [
                    'name' => [
                        'type' => 'text',
                        'label' => 'Title',
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
                    'category_id' => [
                        'type' => 'select',
                        'options' => $args['categories'],
                        'label' => 'Category',
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
                        'label' => 'Excerpt:',
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
                        'label' => 'Thumbnail',
                        'class' => ''
                    ],
                ],
            ],
            [
                'class' => 'form-group row',
                'items' => [
                    'meta_title' => [
                        'type' => 'text',
                        'label' => 'Meta title',
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
                        'label' => 'Meta description',
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
                        'label' => 'Content',
                        'value' => null,
                        'required' => true
                    ]
                ]
            ]
        ]
    ];

    return $form;