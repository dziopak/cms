<?php

$form = [
    'left' => [
        'content_row' => [
            'class' => 'form-group row',
            'items' => [
                'content' => [
                    'type' => 'textarea',
                    'class' => 'tinymce',
                    'label' => __('admin/pages.content'),
                    'value' => null,
                    'required' => true,
                    'container_class' => ''
                ]
            ]
        ]
    ],
    'right' => [
        'thumbnail_row' => [
            'class' => 'form-group row',
            'items' => [
                'file_id' => [
                    'type' => 'image',
                    'value' => $args['thumbnail'],
                    'label' => __('admin/pages.thumbnail'),
                    'endpoint' => $args['thumbnail_endpoint'] ?? null,
                    'class' => '',
                    'container_class' => ''
                ],
            ],
        ],
        'name_row' => [
            'class' => 'form-group row',
            'items' => [
                'name' => [
                    'type' => 'text',
                    'label' => __('admin/pages.name'),
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
                    'label' => __('admin/pages.slug'),
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => '',
                    'disabled' => true
                ],
            ],
        ],
        'layout_row' => [
            'class' => 'form-group row',
            'items' => [
                'layout_id' => [
                    'type' => 'select',
                    'options' => $args['layouts'],
                    'label' => __('admin/pages.layout'),
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container-class' => ''
                ]
            ]
        ],
        'excerpt_row' => [
            'class' => 'form-group row',
            'items' => [
                'excerpt' => [
                    'type' => 'textarea',
                    'label' => __('admin/pages.excerpt'),
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => ''
                ],
            ]
        ],
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
        ],
        'index_follow_row' => [
            'class' => 'form-group',
            'items' => [
                'index' => [
                    'type' => 'checkbox',
                    'label' => __('admin/pages.index'),
                    'value' => null,
                    'checked_value' => 1,
                    'class' => '',
                    'container_class' => '',
                ],
            ]
        ]
    ],
];
return Eventy::filter('page.sources.form', $form);
