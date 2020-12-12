<?php
$form = [
    'right' => [
        'thumbnail_row' => [
            'class' => 'form-group row',
            'items' => [
                'file_id' => [
                    'type' => 'image',
                    'value' => $args['thumbnail'],
                    'label' => __('admin/posts.thumbnail'),
                    'endpoint' => $args['thumb_endpoint'] ?? null,
                    'class' => '',
                    'container_class' => 'tinymce',
                ],
            ],
        ],
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
        'slug_row' => [
            'class' => 'form-group row',
            'items' => [
                'slug' => [
                    'type' => 'text',
                    'label' => __('admin/posts.slug'),
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => 'tinymce',
                    'disabled' => true
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
        ],
    ],
    'seo' => [
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
                    'container_class' => 'tinymce'
                ]
            ]
        ]
    ],
    'relations' => [
        'category_row' => [
            'class' => 'form-group row',
            'items' => [
                'category' => [
                    'type' => 'select',
                    'options' => $args['categories'],
                    'label' => __('admin/posts.category'),
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => 'tinymce',
                    'custom' => 'add-button'
                ],
            ],
        ],
        'tag_row' => [
            'class' => 'form-group row',
            'items' => [
                'tag' => [
                    'type' => 'text',
                    'label' => __('admin/posts.tag'),
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => 'tinymce',
                    'custom' => 'add-button'
                ]
            ],
        ],
    ],
    'left' => [
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
return Hook::filter('post.sources.form', $form);
