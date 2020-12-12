<?php
$form = [
    'dashboard' => [
        'class' => 'icon fa fas fa-home',
        'route' => 'admin.dashboard.index'
    ],
    'pages' => [
        'class' => 'icon fa far fa-file',
        'route' => 'admin.pages.index',
        'items' => [
            'list' => [
                'route' => 'admin.pages.index',
            ],
            'create' => [
                'route' => 'admin.pages.create',
            ],
            'layouts' => [
                'route' => 'admin.pages.layouts.index',
            ],
        ],
    ],
    'posts' => [
        'class' => 'icon fa fas fa-book',
        'route' => 'admin.posts.index',
        'items' => [
            'list' => [
                'route' => 'admin.posts.index',
            ],
            'create' => [
                'route' => 'admin.posts.create',
            ],
        ],
    ],
    'categories' => [
        'class' => 'icon fa fas fa-folder',
        'route' => 'admin.categories.index',
        'items' => [
            'list' => [
                'route' => 'admin.categories.index',
            ],
            'create' => [
                'route' => 'admin.categories.create',
            ],
        ],
    ],
    'users' => [
        'class' => 'icon fa fas fa-user-circle',
        'route' => 'admin.users.index',
        'items' => [
            'list' => [
                'route' => 'admin.users.index'
            ],
            'create' => [
                'route' => 'admin.users.create'
            ],
            'roles' => [
                'route' => 'admin.users.roles.index'
            ],
        ]
    ],
    'appearance' => [
        'class' => 'icon fa fas fa-columns',
        'route' => 'admin.dashboard.index',
        'items' => [
            'menus' => [
                'route' => 'admin.blocks.menus.index'
            ],
            'carousels' => [
                'route' => 'admin.blocks.carousels.index'
            ],
            'sliders' => [
                'route' => 'admin.blocks.sliders.index'
            ],
            // 'forms' => [
            //     'route' => 'admin.dashboard.index'
            // ],
        ]
    ],
    'media' => [
        'class' => 'icon fa fas fa-image',
        'route' => 'admin.media.index'
    ],
    'addons' => [
        'class' => 'icon fa fas fa-plug',
        'route' => 'admin.plugins.index',
        // 'items' => [
        // 'modules' => [
        //     'route' => 'admin.plugins.index',
        // ],
        // 'bridges' => [
        //     'route' => 'admin.dashboard.index',
        // ],
        // 'store' => [
        //     'route' => 'admin.dashboard.index',
        // ],
        // ]
    ],
    'settings' => [
        'class' => 'icon fa fas fa-cogs',
        'route' => 'admin.settings.general',
        'items' => [
            'general' => [
                'route' => 'admin.settings.general',
            ],
            'content' => [
                'route' => 'admin.settings.content',
            ],
            // 'seo' => [
            //     'route' => 'admin.dashboard.index',
            // ],
            // 'mail' => [
            //     'route' => 'admin.dashboard.index',
            // ],
            'logs' => [
                'route' => 'admin.settings.logs.index',
            ],
        ]
    ]
];

return Hook::filter('sources.components.sidebar', $form);
