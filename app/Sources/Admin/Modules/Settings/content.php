<?php

$form = [
    'posts' => [
        'layouts_row' => [
            'class' => 'form-group row',
            'items' => [
                'post_listing_layout' => [
                    'type' => 'select',
                    'label' => 'Post listing layout',
                    'required' => true,
                    'value' => config('global')['content']['post_listing_layout'] ?? "",
                    'class' => 'small',
                    'options' => $args['layouts']
                ],
                'post_single_layout' => [
                    'type' => 'select',
                    'label' => 'Single post layout',
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
                    'label' => 'Default category layout',
                    'required' => true,
                    'value' => config('global')['content']['post_category_layout'] ?? "",
                    'class' => 'small',
                    'options' => $args['layouts']
                ],
            ]
        ],
    ],
    'pages' => [
        'layouts_row' => [
            'class' => 'form-group row',
            'items' => [
                'page_layout' => [
                    'type' => 'select',
                    'label' => 'Default page layout',
                    'required' => true,
                    'value' => config('global')['content']['page_layout'] ?? "",
                    'class' => 'small',
                    'options' => $args['layouts']
                ],
                'page_category_layout' => [
                    'type' => 'select',
                    'label' => 'Default category layout',
                    'required' => true,
                    'value' => config('global')['content']['page_category_layout'] ?? "",
                    'class' => 'small',
                    'options' => $args['layouts']
                ],
            ]
        ],
    ],
];

return $form;
