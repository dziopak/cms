<?php
$items = [
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
            'categories' => [
                'route' => 'admin.pages.categories.index',
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
            'categories' => [
                'route' => 'admin.posts.categories.index',
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
            'carousells' => [
                'route' => 'admin.dashboard.index'
            ],
            'sliders' => [
                'route' => 'admin.blocks.sliders.index'
            ],
            'forms' => [
                'route' => 'admin.dashboard.index'
            ],
        ]
    ],
    'media' => [
        'class' => 'icon fa fas fa-image',
        'route' => 'admin.media.index'
    ],
    'addons' => [
        'class' => 'icon fa fas fa-plug',
        'route' => 'admin.dashboard.index',
        'items' => [
            'modules' => [
                'route' => 'admin.plugins.index',
            ],
            'widgets' => [
                'route' => 'admin.dashboard.index',
            ],
            'store' => [
                'route' => 'admin.dashboard.index',
            ],
        ]
    ],
    'settings' => [
        'class' => 'icon fa fas fa-cogs',
        'route' => 'admin.settings.general.index',
        'items' => [
            'general' => [
                'route' => 'admin.settings.general.index',
            ],
            'seo' => [
                'route' => 'admin.dashboard.index',
            ],
            'mail' => [
                'route' => 'admin.dashboard.index',
            ],
            'logs' => [
                'route' => 'admin.settings.logs.index',
            ],
        ]
    ]
];


$items = Hook::get('adminSidebarItems', [$items], function ($items) {
    return $items;
});

return $items;
