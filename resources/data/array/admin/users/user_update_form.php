<?php
    $form = [
        'left' => [
            [
                'class' => 'form-group row',
                'items' => [
                    'first_name' => [
                        'type' => 'text',
                        'label' => 'First name',
                        'required' => false,
                        'value' => null,
                        'class' => ''
                    ],
                    'last_name' => [
                        'type' => 'text',
                        'label' => 'Last name',
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
                        'label' => 'User\'s role',
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
                        'label' => 'Email',
                        'required' => true,
                        'value' => null,
                        'class' => ''
                    ],
                ]
            ],    
            [
                'class' => 'form-group row',
                'items' => [
                    'avatar' => [
                        'type' => 'file',
                        'label' => 'Avatar:',
                        'required' => false,
                        'value' => null,
                        'class' => ''
                    ],
                ]
            ],    
        ],
        'right' => [
            [
                'class' => 'form-group row',
                'items' => [
                    'password' => [
                        'type' => 'password',
                        'label' => 'Password',
                        'required' => true,
                        'value' => null,
                        'class' => ''
                    ],
                    'repeat_password' => [
                        'type' => 'password',
                        'label' => 'Repeat password',
                        'required' => true,
                        'value' => null,
                        'class' => ''
                    ],
                ]
            ],
        ]
    ];

    return $form;