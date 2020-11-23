<?php
return [
    'general_title' => 'Ustawienia generalne',
    'general_description' => 'Znajdziesz tu podstawowe ustawienia twojego serwisu.',

    'general' => [
        'title' => 'Tytuł strony',
        'description' => 'Opis',
        'lang' => 'Domyślny język',
        'theme' => 'Motyw',
        'tables' => 'Tabele danych',
        'layout' => 'Domyślny szablon'
    ],

    'content_title' => 'Ustawienia treści',
    'content_description' => 'Znajdziesz tu ustawienia dotyczące wszelakiego rodzaju treści, takich jak posty, podstrony, komentarze i inne.',

    'content' => [
        'home' => [
            'title' => 'Strona główna',
            'description' => 'Ustawienia treści wyświetlanych na stronie głównej.',

            'type' => 'Rodzaj treści',
            'types' => [
                'posts' => 'Wyświetl posty',
                'page' => 'Strona statyczna'
            ],

            'per_page' => 'Postów na stronę',
            'layout' => 'Szablon',
            'page_id' => 'ID lub slug podstrony'
        ],

        'posts' => [
            'title' => 'Posty',
            'description' => 'Ustawienia związane z postami.',

            'listing_layout' => 'Szablon listingu',
            'single_layout' => 'Szablon pojedynczego wpisu',

            'category_layout' => 'Szablon kategorii'
        ],

        'pages' => [
            'title' => 'Podstrony',
            'description' => 'Ustawienia związane z podstronami.',

            'default_layout' => 'Domyślny szablon podstron',
            'category_layout' => 'Szablon kategorii'
        ],

        'users' => [
            'title' => 'Użytkownicy',
            'description' => 'Ustawienia związane z modułem użytkowników.'
        ],

        'admin_per_page' => 'Wpisów na stronę [Admin]',
        'front_per_page' => 'Wpisów na stronę [Front]',
        'api_per_page' => 'Wpisów na stronę [API]',

    ]
];
