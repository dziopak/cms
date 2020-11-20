<?php
$form = [
    'left' => [
        [
            'class' => 'form-group row',
            'items' => [
                'name' => [
                    'type' => 'text',
                    'label' => __('admin/roles.name'),
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
                    'label' => __('admin/roles.description'),
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
            'label' => __('admin/roles.general_rules'),
            'items' => [
                'access[ADMIN_VIEW]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.admin_view'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[MODULE_USE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.module_use'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[MENU_EDIT]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.menu_edit'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
            ],
        ],
        [
            'class' => 'form-group',
            'label' => __('admin/roles.users_rules'),
            'items' => [
                'access[USER_CREATE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.user_create'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[USER_EDIT]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.user_edit'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[USER_PASSWORD]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.user_password'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[USER_ROLE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.user_role'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[USER_DELETE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.user_delete'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
            ],
        ],
        [
            'class' => 'form-group',
            'label' => __('admin/roles.roles_rules'),
            'items' => [
                'access[ROLE_CREATE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.role_create'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[ROLE_EDIT]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.role_edit'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[ROLE_DELETE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.role_delete'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
            ],
        ],
        [
            'class' => 'form-group',
            'label' => __('admin/roles.categories_rules'),
            'items' => [
                'access[CATEGORY_CREATE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.category_create'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[CATEGORY_EDIT]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.category_edit'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[CATEGORY_DELETE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.category_delete'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
            ],
        ],
        [
            'class' => 'form-group',
            'label' => __('admin/roles.pages_rules'),
            'items' => [
                'access[PAGE_CREATE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.page_create'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[PAGE_EDIT]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.page_edit'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[PAGE_DELETE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.page_delete'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
            ],
        ],
        [
            'class' => 'form-group',
            'label' => __('admin/roles.layouts_rules'),
            'items' => [
                'access[LAYOUT_CREATE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.layout_create'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[LAYOUT_EDIT]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.layout_edit'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[LAYOUT_DELETE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.layout_delete'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
            ],
        ],
        [
            'class' => 'form-group',
            'label' => __('admin/roles.posts_rules'),
            'items' => [
                'access[POST_CREATE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.post_create'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[POST_EDIT]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.post_edit'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[POST_DELETE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.post_delete'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
            ],
        ],
        [
            'class' => 'form-group',
            'label' => __('admin/roles.files_rules'),
            'items' => [
                'access[FILE_CREATE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.file_create'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[FILE_EDIT]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.file_edit'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[FILE_DELETE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.file_delete'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
            ],
        ],
        [
            'class' => 'form-group',
            'label' => __('admin/roles.blocks_rules'),
            'items' => [
                'access[BLOCK_CREATE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.block_create'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[BLOCK_EDIT]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.block_edit'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
                'access[BLOCK_DELETE]' => [
                    'type' => 'checkbox',
                    'label' => __('admin/roles.block_delete'),
                    'class' => '',
                    'value' => null,
                    'checked_value' => 1
                ],
            ],
        ],
    ],
];

return $form;
