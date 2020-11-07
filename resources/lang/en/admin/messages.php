<?php
return [
    'categories' => [
        'create' => [
            'success' => 'Successfully created new category.'
        ],
        'update' => [
            'success' => 'Successfully updated selected page.'
        ],
        'delete' => [
            'success' => 'Category deleted successfully.'
        ],
        'mass' => [
            'errors' => [
                'no_categories' => 'No categories selected.'
            ]
        ],
    ],
    'pages' => [
        'create' => 'Successfully created a page.',
        'update' => [
            'thumbnail' => [
                'success' => 'Successfully updated page thumbnail.'
            ],
            'success' => 'Successfully updated selected page.'
        ],
        'delete' => [
            'success' => 'Page deleted successfully.'
        ],
        'mass' => [
            'assign_category' => 'Successfully assigned category to selected pages.',
            'title_replace_phrases' => 'Successfully replaced titles of selected pages.',
            'universal' => 'Successfully completed selected operations.',
            'errors' => [
                'no_pages' => 'No pages selected.'
            ]
        ],
    ],
    'posts' => [
        'update' => [
            'thumbnail' => [
                'success' => 'Successfully updated post thumbnail.'
            ],
            'success' => 'Successfully updated selected post.',
        ],
        'create' => [
            'success' => 'Successfully created new post.'
        ],
        'delete' => [
            'success' => 'Post deleted successfully.'
        ],
        'mass' => [
            'title_replace_phrases' => 'Successfully replaced titles of selected posts.',
            'assign_category' => 'Successfully assigned category to selected posts.',
            'errors' => [
                'no_posts' => 'No posts selected.'
            ]
        ]
    ],
    'roles' => [
        'update' => [
            'success' => 'Successfully updated selected role.',
        ],
        'create' => [
            'success' => 'Successfully created new role.'
        ],
        'delete' => [
            'success' => 'Role successfulyl deleted.'
        ],
        'mass' => [
            'errors' => [
                'no_roles' => 'No roles selected.'
            ]
        ]
    ],
    'layouts' => [
        'update' => [
            'success' => 'Layout updated successfully.'
        ],
        'create' => [
            'success' => 'Layout created successfully.'
        ],
        'delete' => 'Layout deleted successfully.'
    ],
    'users' => [
        'create' => [
            'success' => 'Successfully created new user.'
        ],
        'update' => [
            'thumbnail' => [
                'success' => 'Successfully updated user\'s photo.'
            ],
            'success' => 'Successfully updated selected user.'
        ],
        'delete' => [
            'success' => 'Successfully deleted selected user.'
        ],
        'mass' => [
            'errors' => [
                'no_users' => 'No users selected.'
            ]
        ]
    ],
    'files' => [
        'delete' => [
            'success' => 'Successfully deleted the file.'
        ],
        'mass' => [
            'delete' => 'Files has been successfully deleted.',
            'errors' => [
                'no_files' => 'No files selected.',
            ]
        ]
    ],
    'blocks' => [
        'menu' => [
            'items' => [
                'order' => 'Successfuly ordered menu items.',
                'attach' => 'Successfuly attached menu item.',
                'detach' => 'Successfuly detached menu item.',
                'update' => 'Successfuly updated menu item.',
                'search' => 'Search performed successfully.'
            ],
            'delete' => [
                'success' => 'Successfuly deleted a menu'
            ],
            'mass' => [
                'delete' => 'Successfully deleted selected menus.'
            ]
        ],
        'sliders' => [
            'items' => [
                'attach' => 'Slides attached successfully',
                'detach' => 'Slides detached successfully.'
            ],
            'update' => [
                'success' => 'Slider successfully updated.',
            ],
            'delete' => [
                'success' => 'Slider successfully deleted.',
            ],
            'mass' => [
                'delete' => 'Successfully deleted selected sliders.'
            ]
        ],
        'carousels' => [
            'items' => [
                'attach' => 'Slides attached successfully',
                'detach' => 'Slides detached successfully.'
            ],
            'update' => [
                'success' => 'Carousel successfully updated.',
            ],
            'delete' => [
                'success' => 'Carousel successfully deleted.',
            ],
            'mass' => [
                'delete' => 'Successfully deleted selected carousels.'
            ]
        ]
    ],
    'plugins' => [
        'disable' => [
            'success' => 'Plugin disabled successfully.'
        ],
        'enable' => [
            'success' => 'Plugin enabled successfully.'
        ]
    ]
];
