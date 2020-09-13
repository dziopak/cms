<?php
$form = [
    'thumbnail' => [
        'thumbnail_row' => [
            'class' => '',
            'items' => [
                'thumbnail' => [
                    'type' => 'image',
                    'value' => $args['thumbnail'],
                    'label' => __('admin/general.thumbnail'),
                    'endpoint' => $args['thumbnail_endpoint'] ?? null,
                    'class' => '',
                    'container_class' => ''
                ]
            ]
        ]
    ],
    'basic_data' => [
        'name_row' => [
            'class' => 'form-group row',
            'items' => [
                'name' => [
                    'type' => 'text',
                    'label' => __('portfolio::langs.name'),
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
                    'label' => __('portfolio::langs.slug'),
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => ''
                ],
            ],
        ],
    ],

    'project_content' => [
        'intro_row' => [
            'class' => 'form-group col-md-6 p-0',
            'items' => [
                'intro' => [
                    'type' => 'textarea',
                    'label' => __('portfolio::langs.intro'),
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => ''
                ],
            ]
        ],
        'description_row' => [
            'class' => 'form-group col-md-6 p-0',
            'items' => [
                'description' => [
                    'type' => 'textarea',
                    'label' => __('portfolio::langs.description'),
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => ''
                ]
            ]
        ]
    ]
];

$form = Hook::get('pluginPortfolioFormFields', [$form], function ($form) {
    return $form;
});

return $form;
