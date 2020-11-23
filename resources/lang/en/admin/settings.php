<?php
return [
    'general_title' => 'General settings',
    'general_description' => 'You will find here basic settings of your site.',

    'general' => [
        'title' => 'Site title',
        'description' => 'Description',
        'lang' => 'Language',
        'theme' => 'Theme',
        'tables' => 'Data tables',
        'layout' => 'Default layout'
    ],

    'content_title' => 'Content settings',
    'content_description' => 'You will find here settings related to any kind of content like posts, pages, comments etc.',

    'content' => [
        'home' => [
            'title' => 'Homepage',
            'description' => 'Settings of content displayed on the homepage.',

            'type' => 'Content type',
            'types' => [
                'posts' => 'Display posts',
                'page' => 'Static page'
            ],

            'per_page' => 'Posts per page',
            'layout' => 'Layout',
            'page_id' => 'Page slug or ID'
        ],

        'posts' => [
            'title' => 'Posts',
            'description' => 'Settings related to posts.',

            'listing_layout' => 'Post listing layout',
            'single_layout' => 'Single post layout',

            'category_layout' => 'Category listing layout'
        ],

        'pages' => [
            'title' => 'Pages',
            'description' => 'Settings related to pages.',

            'default_layout' => 'Default page layout',
            'category_layout' => 'Category listing layout'
        ],

        'users' => [
            'title' => 'Users',
            'description' => 'Display settings of users module'
        ],

        'admin_per_page' => 'Items per page [Admin]',
        'front_per_page' => 'Items per page [Front]',
        'api_per_page' => 'Items per page [API]',
    ]
];
