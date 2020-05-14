<?php
$form = [
    'basic_data' => [
        [
            'class' => 'form-group row',
            'items' => [
                'first_name' => [
                    'type' => 'text',
                    'label' => __('admin/users.first_name'),
                    'required' => false,
                    'value' => null,
                    'class' => ''
                ],
                'last_name' => [
                    'type' => 'text',
                    'label' => __('admin/users.last_name'),
                    'required' => false,
                    'value' => null,
                    'class' => ''
                ],
            ],
        ],
        [
            'class' => 'form-group row',
            'items' => [
                'role_id' => [
                    'type' => 'select',
                    'options' => $args['roles'],
                    'label' => __('admin/users.role'),
                    'required' => true,
                    'value' => null,
                    'class' => ''
                ],
            ],
        ],
        [
            'class' => 'form-group row',
            'items' => [
                'email' => [
                    'type' => 'email',
                    'label' => __('admin/users.email'),
                    'required' => true,
                    'value' => null,
                    'class' => ''
                ],
            ]
        ],
    ],
    'profile' => [
        'avatar' => [
            'avatar_row' => [
                'class' => 'form-group row',
                'items' => [
                    'avatar' => [
                        'type' => 'image',
                        'value' => $args['thumbnail'],
                        'label' => __('admin/users.avatar'),
                        'required' => false,
                        'class' => '',
                        'container_class' => 'ml-2',
                        'endpoint' => $args['thumb_endpoint']
                    ],
                ]
            ]
        ]
    ],
    'password_change' => [
        [
            'class' => 'form-group row',
            'items' => [
                'password' => [
                    'type' => 'password',
                    'label' => __('admin/users.password'),
                    'required' => true,
                    'value' => null,
                    'class' => ''
                ],
                'repeat_password' => [
                    'type' => 'password',
                    'label' => __('admin/users.repeat_password'),
                    'required' => true,
                    'value' => null,
                    'class' => ''
                ],
            ]
        ],
    ]
];

return $form;
