<?php
    $form = [
        'left' => [
            [
                'class' => 'form-group row',
                'items' => [
                    'name' => [
                        'type' => 'text',
                        'label' => 'Name',
                        'required' => true,
                        'value' => null,
                        'class' => ''
                    ],
                ],
            ],
            [
                'class' => 'form-group row',
                'items' => [
                    'description' => [
                        'type' => 'textarea',
                        'label' => 'Description:',
                        'required' => true,
                        'value' => null,
                        'class' => ''
                    ],
                ]
            ]    
        ],
        'right' => [
            [
                'class' => 'form-group',
                'label' => 'General rules',
                'items' => [
                    'access[ADMIN_VIEW]' => [
                        'type' => 'checkbox',
                        'label' => 'Admin panel view',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                    'access[MODULE_USE]' => [
                        'type' => 'checkbox',
                        'label' => 'Manage modules',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                    'access[MENU_EDIT]' => [
                        'type' => 'checkbox',
                        'label' => 'Edit menus',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                ],
            ],
            [
                'class' => 'form-group',
                'label' => 'Users rules',
                'items' => [
                    'access[USER_CREATE]' => [
                        'type' => 'checkbox',
                        'label' => 'Create new users',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                    'access[USER_EDIT]' => [
                        'type' => 'checkbox',
                        'label' => 'Edit users',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                    'access[USER_PASSWORD]' => [
                        'type' => 'checkbox',
                        'label' => 'Edit user password',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                    'access[USER_ROLE]' => [
                        'type' => 'checkbox',
                        'label' => 'Change user\'s role',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                    'access[USER_DELETE]' => [
                        'type' => 'checkbox',
                        'label' => 'Delete users',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                ],
            ],
            [
                'class' => 'form-group',
                'label' => 'Roles rules',
                'items' => [
                    'access[ROLE_CREATE]' => [
                        'type' => 'checkbox',
                        'label' => 'Create new roles',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                    'access[ROLE_EDIT]' => [
                        'type' => 'checkbox',
                        'label' => 'Edit roles',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                    'access[ROLE_DELETE]' => [
                        'type' => 'checkbox',
                        'label' => 'Delete roles',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                ],
            ],
            [
                'class' => 'form-group',
                'label' => 'Categories rules',
                'items' => [
                    'access[CATEGORY_CREATE]' => [
                        'type' => 'checkbox',
                        'label' => 'Create new categories',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                    'access[CATEGORY_EDIT]' => [
                        'type' => 'checkbox',
                        'label' => 'Edit categories',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                    'access[CATEGORY_DELETE]' => [
                        'type' => 'checkbox',
                        'label' => 'Delete categories',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                ],
            ],
            [
                'class' => 'form-group',
                'label' => 'Page rules',
                'items' => [
                    'access[PAGE_CREATE]' => [
                        'type' => 'checkbox',
                        'label' => 'Create new pages',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                    'access[PAGE_EDIT]' => [
                        'type' => 'checkbox',
                        'label' => 'Edit pages',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                    'access[PAGE_DELETE]' => [
                        'type' => 'checkbox',
                        'label' => 'Delete pages',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                ],
            ],
            [
                'class' => 'form-group',
                'label' => 'Post rules',
                'items' => [
                    'access[POST_CREATE]' => [
                        'type' => 'checkbox',
                        'label' => 'Create new posts',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                    'access[POST_EDIT]' => [
                        'type' => 'checkbox',
                        'label' => 'Edit posts',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                    'access[POST_DELETE]' => [
                        'type' => 'checkbox',
                        'label' => 'Delete posts',
                        'class' => '',
                        'value' => null,
                        'checked_value' => 1
                    ],
                ],
            ],
        ],
        'bottom' => [
            [
                'class' => 'form-group row',
                'items' => [
                    'content' => [
                        'type' => 'textarea',
                        'class' => 'tinymce',
                        'label' => 'Content',
                        'value' => null,
                        'required' => true
                    ]
                ]
            ]
        ]
    ];

    return $form;