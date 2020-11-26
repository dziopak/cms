<?php

$form = [
    'home' => [
        'homepage_type_row' => [
            'class' => 'form-group row',
            'items' => [
                'homepage_type' => [
                    'type' => 'select',
                    'label' => __('admin/settings.content.home.type'),
                    'required' => true,
                    'value' => config('global')['content']['homepage_type'] ?? "",
                    'class' => 'small',
                    'options' => [
                        'posts' => __('admin/settings.content.home.types.posts'),
                        'page' => __('admin/settings.content.home.types.page')
                    ]
                ]
            ]
        ],
        'posts_row' => [
            'class' => 'form-group row',
            'items' => [
                'homepage_posts_per_page' => [
                    'type' => 'number',
                    'label' => __('admin/settings.content.home.per_page'),
                    'required' => true,
                    'value' => config('global')['content']['homepage_posts_per_page'] ?? 15,
                    'class' => 'small',
                ],
                'homepage_post_listing_layout' => [
                    'type' => 'select',
                    'label' => __('admin/settings.content.home.layout'),
                    'required' => true,
                    'value' => config('global')['content']['homepage_post_listing_layout'] ?? "",
                    'class' => 'small',
                    'options' => $args['layouts']
                ],
            ]
        ],
        'page_row' => [
            'class' => 'form-group row',
            'items' => [
                'homepage_page_id' => [
                    'type' => 'text',
                    'label' => __('admin/settings.content.home.page_id'),
                    'required' => true,
                    'value' => config('global')['content']['homepage_page_id'] ?? '',
                    'class' => 'small',
                ],
            ]
        ]
    ],
    'posts' => [
        'per_page_row' => [
            'class' => 'form-group row',
            'items' => [
                'front_posts_per_page' => [
                    'type' => 'number',
                    'label' => __('admin/settings.content.front_per_page'),
                    'required' => true,
                    'value' => config('global')['content']['front_posts_per_page'] ?? 15,
                    'class' => 'small',
                ],
                'admin_posts_per_page' => [
                    'type' => 'number',
                    'label' => __('admin/settings.content.admin_per_page'),
                    'required' => true,
                    'value' => config('global')['content']['admin_posts_per_page'] ?? 15,
                    'class' => 'small',
                ],
                'api_posts_per_page' => [
                    'type' => 'number',
                    'label' => __('admin/settings.content.api_per_page'),
                    'required' => true,
                    'value' => config('global')['content']['api_posts_per_page'] ?? 15,
                    'class' => 'small',
                ],
            ]
        ],
        'layouts_row' => [
            'class' => 'form-group row',
            'items' => [
                'post_listing_layout' => [
                    'type' => 'select',
                    'label' => __('admin/settings.content.posts.listing_layout'),
                    'required' => true,
                    'value' => config('global')['content']['post_listing_layout'] ?? "",
                    'class' => 'small',
                    'options' => $args['layouts']
                ],
                'post_single_layout' => [
                    'type' => 'select',
                    'label' => __('admin/settings.content.posts.single_layout'),
                    'required' => true,
                    'value' => config('global')['content']['post_single_layout'] ?? "",
                    'class' => 'small',
                    'options' => $args['layouts']
                ],
            ]
        ],
        'category_layout_row' => [
            'class' => 'form-group row',
            'items' => [
                'post_category_layout' => [
                    'type' => 'select',
                    'label' => __('admin/settings.content.posts.category_layout'),
                    'required' => true,
                    'value' => config('global')['content']['post_category_layout'] ?? "",
                    'class' => 'small',
                    'options' => $args['layouts']
                ],
            ]
        ],
    ],
    'pages' => [
        'per_page_row' => [
            'class' => 'form-group row',
            'items' => [
                'front_pages_per_page' => [
                    'type' => 'number',
                    'label' => __('admin/settings.content.front_per_page'),
                    'required' => true,
                    'value' => config('global')['content']['front_pages_per_page'] ?? 15,
                    'class' => 'small',
                ],
                'admin_pages_per_page' => [
                    'type' => 'number',
                    'label' => __('admin/settings.content.admin_per_page'),
                    'required' => true,
                    'value' => config('global')['content']['admin_pages_per_page'] ?? 15,
                    'class' => 'small',
                ],
                'api_pages_per_page' => [
                    'type' => 'number',
                    'label' => __('admin/settings.content.api_per_page'),
                    'required' => true,
                    'value' => config('global')['content']['api_pages_per_page'] ?? 15,
                    'class' => 'small',
                ],
            ]
        ],
        'layouts_row' => [
            'class' => 'form-group row',
            'items' => [
                'page_layout' => [
                    'type' => 'select',
                    'label' => __('admin/settings.content.pages.default_layout'),
                    'required' => true,
                    'value' => config('global')['content']['page_layout'] ?? "",
                    'class' => 'small',
                    'options' => $args['layouts']
                ],
                'page_category_layout' => [
                    'type' => 'select',
                    'label' => __('admin/settings.content.pages.category_layout'),
                    'required' => true,
                    'value' => config('global')['content']['page_category_layout'] ?? "",
                    'class' => 'small',
                    'options' => $args['layouts']
                ],
            ]
        ],
    ],
    'users' => [
        'per_page_row' => [
            'class' => 'form-group row',
            'items' => [
                'admin_users_per_page' => [
                    'type' => 'number',
                    'label' => __('admin/settings.content.admin_per_page'),
                    'required' => true,
                    'value' => config('global')['content']['admin_users_per_page'] ?? 15,
                    'class' => 'small',
                ],
                'api_users_per_page' => [
                    'type' => 'number',
                    'label' => __('admin/settings.content.api_per_page'),
                    'required' => true,
                    'value' => config('global')['content']['api_users_per_page'] ?? 15,
                    'class' => 'small',
                ],
            ]
        ],
    ],
];

return Eventy::filter('settings.content.sources.form', $form);
