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
