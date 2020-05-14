<?php

$form = [
    'left' => [
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
                    'container_class' => ''
                ],
                'category_id' => [
                    'type' => 'select',
                    'options' => $args['categories'],
                    'label' => __('admin/pages.category'),
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => ''
                ],
            ],
        ],
        'layout_row' => [
            'class' => 'form-group row',
            'items' => [
                'layout' => [
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
        ]
    ],
    'right' => [
        'thumbnail_row' => [
            'class' => 'form-group row',
            'items' => [
                'thumbnail' => [
                    'type' => 'image',
                    'value' => $args['thumbnail'],
                    'label' => __('admin/pages.thumbnail'),
                    'endpoint' => $args['thumbnail_endpoint'] ?? null,
                    'class' => '',
                    'container_class' => ''
                ],
            ],
        ],
        'meta_title_row' => [
            'class' => 'form-group row',
            'items' => [
                'meta_title' => [
                    'type' => 'text',
                    'label' => __('admin/pages.meta_title'),
                    'required' => false,
                    'value' => null,
                    'class' => '',
                    'container_class' => ''
                ],
            ]
        ],
        'meta_description_row' => [
            'class' => 'form-group row',
            'items' => [
                'meta_description' => [
                    'type' => 'textarea',
                    'label' => __('admin/pages.meta_description'),
                    'required' => false,
                    'value' => null,
                    'class' => '',
                    'container_class' => ''
                ],
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
                    'container_class' => ''
                ],
                'follow' => [
                    'type' => 'checkbox',
                    'label' => __('admin/pages.follow'),
                    'value' => null,
                    'checked_value' => 1,
                    'class' => '',
                    'container_class' => ''
                ],
            ]
        ]
    ],
    'bottom' => [
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
    ]
];

$form = Hook::get('pagesFormFields', [$form], function ($form) {
    return $form;
});

return $form;
