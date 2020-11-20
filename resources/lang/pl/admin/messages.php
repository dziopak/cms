<?php
return [
    'categories' => [
        'create' => [
            'success' => 'Pomyślnie utworzono nową kategorię.'
        ],
        'update' => [
            'success' => 'Pomyślnie zaaktualizowano wybraną kategorię.'
        ],
        'delete' => [
            'success' => 'Kategoria usunięta pomyślnie.'
        ],
        'mass' => [
            'universal' => 'Pomyślnie wykonano wskazane operacje.',
            'errors' => [
                'no_categories' => 'Nie wybrano żadnej kategorii.'
            ]
        ],
    ],
    'pages' => [
        'create' => 'Pomyślnie utworzono nową podstronę.',
        'update' => [
            'thumbnail' => [
                'success' => 'Pomyślnie zaaktualizowano miniaturkę wybranej podstrony.'
            ],
            'success' => 'Pomyślnie zaaktualizowano wybraną podstronę.'
        ],
        'delete' => [
            'success' => 'Podstrona usunięta pomyślnie.'
        ],
        'mass' => [
            'assign_category' => 'Pomyślnie przypisano kategorię do wybranych podstron.',
            'title_replace_phrases' => 'Pomyślnie zaaktualizowano frazy w tytułach wybranych podstron.',
            'universal' => 'Pomyślnie wykonano wskazane operacje.',
            'errors' => [
                'no_pages' => 'Nie wybrano żadnej podstrony.'
            ]
        ],
    ],
    'posts' => [
        'update' => [
            'thumbnail' => [
                'success' => 'Pomyślnie zaaktualizowano miniaturkę wybranego posta.'
            ],
            'success' => 'Pomyślnie zaaktualizowano wybrany post.'
        ],
        'create' => [
            'success' => 'Pomyślnie utworzono nowy post.',
        ],
        'delete' => [
            'success' => 'Pomyślnie usunięto wybrany post.'
        ],
        'mass' => [
            'title_replace_phrases' => 'Pomyślnie zaaktualizowano frazy w tytułach wybranych postów.',
            'assign_category' => 'Pomyślnie przypisano kategorię do wybranych postów.',
            'errors' => [
                'no_posts' => 'Nie wybrano żadnych postów.'
            ]
        ]
    ],
    'role' => [
        'update' => [
            'success' => 'Pomyślnie zaaktualizowano wybraną rangę.'
        ],
        'create' => [
            'success' => 'Pomyślnie utworzono nową rangę.',
        ],
        'delete' => [
            'success' => 'Pomyślnie usunięto wybraną rangę.'
        ],
        'mass' => [
            'errors' => [
                'no_roles' => 'Nie wybrano żadnych rang..'
            ]
        ]
    ],
    'layouts' => [
        'update' => [
            'success' => 'Pomyślnie zaaktualizowano wybrany szablon.'
        ],
        'create' => [
            'success' => 'Pomyślnie utworzono nowy szablon.'
        ],
        'delete' => 'Pomyślnie usunięto wybrany szablon.',
        'mass' => [
            'universal' => 'Pomyślnie wykonano wskazane operacje.',
        ]
    ],
    'users' => [
        'create' => [
            'success' => 'Pomyślnie utworzono nowe konto użytkownika.'
        ],
        'update' => [
            'thumbnail' => [
                'success' => 'Pomyślnie zaaktualizowano zdjęcie wybranego użytkownika.'
            ],
            'success' => 'Pomyślnie zaaktualizowano dane wybranego użytkownika.'
        ],
        'delete' => [
            'success' => 'Pomyślnie usunięto wybrane konto użytkownika.'
        ],
        'mass' => [
            'errors' => [
                'universal' => 'Pomyślnie wykonano wskazane operacje.',
                'no_users' => 'Nie wybrano żadnego użytkownika.'
            ]
        ]
    ],
    'files' => [
        'delete' => [
            'success' => 'Plik został pomyślnie usunięty.'
        ],
        'mass' => [
            'delete' => 'Pomyślnie usunięto wybrane pliki.',
            'errors' => [
                'no_files' => 'Nie wybrano żadnego pliku.',
            ]
        ]
    ],
    'blocks' => [
        'menu' => [
            'items' => [
                'order' => 'Pomyślnie posortowano pozycje w menu.',
                'attach' => 'Pomyślnie przypisano nową pozycję w menu.',
                'detach' => 'Pomyślnie usunięto pozycję z wybranego menu.',
                'update' => 'Pomyślnie zaaktualizowano pozycję menu.',
                'search' => 'Szukanie zakończone pomyślnie.'
            ],
            'delete' => [
                'success' => 'Pomyślnie usunięto wybrane menu.'
            ],
            'mass' => [
                'delete' => 'Successfully deleted selected menus.'
            ]
        ],
        'sliders' => [
            'items' => [
                'attach' => 'Pomyślnie dodano nowe slajdy.',
                'detach' => 'Pomyślnie usunięto wybrane slajdy.'
            ],
            'update' => [
                'success' => 'Pomyślnie zaaktualizowano wybrany slider.',
            ],
            'delete' => [
                'success' => 'Pomyślnie usunięto wybrany slider.',
            ],
            'mass' => [
                'delete' => 'Pomyślnie usunięto wybrane slidery.'
            ]
        ]
    ],
    'plugins' => [
        'disable' => [
            'success' => 'Pomyślnie wyłączono wtyczkę.'
        ],
        'enable' => [
            'success' => 'Pomyślnie włączono wybraną wtyczkę.'
        ]
    ]
];
