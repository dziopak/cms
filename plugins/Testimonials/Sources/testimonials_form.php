<?php
$form = [
    'basic_data' => [
        'author_row' => [
            'class' => 'form-group row',
            'items' => [
                'author' => [
                    'type' => 'text',
                    'label' => 'Author',
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => ''
                ],
                'author_title' => [
                    'type' => 'text',
                    'label' => 'Author\'s title',
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => ''
                ],
            ],
        ],
        'content_row' => [
            'class' => 'form-group row',
            'items' => [
                'content' => [
                    'type' => 'textarea',
                    'label' => 'Content',
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => ''
                ]
            ]
        ]
    ],
    'thumbnail' => [
        'thumbnail_row' => [
            'class' => 'form-group row',
            'items' => [
                'file_id' => [
                    'type' => 'image',
                    'label' => 'Thumbnail',
                    'required' => false,
                    'value' => $args['thumbnail'],
                    'endpoint' => null,
                    'class' => '',
                    'container_class' => 'py-4'
                ],
            ]
        ],
        'background_color_row' => [
            'class' => 'form-group row',
            'items' => [
                'background_color' => [
                    'type' => 'text',
                    'label' => 'Background color',
                    'required' => true,
                    'value' => null,
                    'class' => '',
                    'container_class' => ''
                ],
            ],
        ],
    ]
];

$form = Hook::get('pluginTestimonialsFormFields', [$form], function ($form) {
    return $form;
});

return $form;
