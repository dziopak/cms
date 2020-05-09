<?php

return [

    /*
     *
     * Shared translations.
     *
     */
    'title' => 'Instalacja D-CMS',
    'next' => 'Następny krok',
    'close' => 'Zamknij',
    'forms' => [
        'errorTitle' => 'Wystąpiły następujące błędy:',
    ],

    /*
     *
     * Home page translations.
     *
     */
    'welcome' => [
        'title'   => 'Witaj w instalatorze D-CMS',
        'message' => 'Podążaj za instrukcjami zawartymi na każdym etapie kreatora aby pomyślnie zakończyć proces instalacji.',
        'next' => 'Kontynuuj'
    ],

    /*
     *
     * Requirements page translations.
     *
     */
    'requirements' => [
        'title' => 'Wymagania systemowe',
        'message' => 'Ten kreator pozwoli Ci sprawdzić czy twoje środowisko spełnia wszystkie wymagania systemowe.',
        'version' => 'wersja',
        'next' => 'Kontynuuj'
    ],

    /*
     *
     * Permissions page translations.
     *
     */
    'permissions' => [
        'title' => 'Uprawnienia',
        'message' => 'W tym kroku sprawdzimy czy twoje środowisko ma odpowiednie uprawnienia.',
        'next' => 'Kontynuuj'
    ],

    /*
     *
     * Environment page translations.
     *
     */
    'environment' => [
        'menu' => [
            'templateTitle' => 'Step 3 | Environment Settings',
            'title' => 'Konfiguracja',
            'desc' => 'Wybierz sposób w jaki chcesz edytować plik <code>.env</code> przechowujący dane środowiskowe.',
            'wizard-button' => 'Użyj kreatora',
            'classic-button' => 'Ustaw ręcznie',
        ],
        'title' => 'Ustawnienia środowiska',
        'save' => 'Zapisz .env',
        'success' => 'Plik .env został poprawnie zainstalowany.',
        'errors' => 'Nie można zapisać pliku .env, Proszę utworzyć go ręcznie.',
        'classic' => [
            'templateTitle' => 'Step 3 | Environment Settings | Classic Editor',
            'title' => 'Classic Environment Editor',
            'save' => 'Zapisz .env',
            'back' => 'Użyj kreatora',
            'install' => 'Instalacja',
        ],
        'wizard' => [
            'templateTitle' => 'Step 3 | Environment Settings | Guided Wizard',
            'title' => 'Guided <code>.env</code> Wizard',
            'tabs' => [
                'environment' => 'Główne',
                'database' => 'Baza danych',
                'mailing' => 'Poczta',
                'application' => 'Inne',
            ],
            'form' => [
                'name_required' => 'Tytuł strony jest wymagany.',
                'app_name_label' => 'Tytuł strony',
                'app_name_placeholder' => 'Tytuł...',
                'app_environment_label' => 'Środowisko',
                'app_environment_label_local' => 'Lokalne',
                'app_environment_label_developement' => 'Development',
                'app_environment_label_qa' => 'Qa',
                'app_environment_label_production' => 'Production',
                'app_environment_label_other' => 'Inne',
                'app_environment_placeholder_other' => 'Podaj środowisko...',
                'app_debug_label' => 'Debugowanie',
                'app_debug_label_true' => 'Włącz',
                'app_debug_label_false' => 'Wyłącz',
                'app_log_level_label' => 'Log Level',
                'app_log_level_label_debug' => 'debug',
                'app_log_level_label_info' => 'info',
                'app_log_level_label_notice' => 'notice',
                'app_log_level_label_warning' => 'warning',
                'app_log_level_label_error' => 'error',
                'app_log_level_label_critical' => 'critical',
                'app_log_level_label_alert' => 'alert',
                'app_log_level_label_emergency' => 'emergency',
                'app_url_label' => 'Adres strony',
                'app_url_placeholder' => 'App Url',
                'db_connection_failed' => 'Could not connect to the database.',
                'db_connection_label' => 'Silnik bazy',
                'db_connection_label_mysql' => 'mysql',
                'db_connection_label_sqlite' => 'sqlite',
                'db_connection_label_pgsql' => 'pgsql',
                'db_connection_label_sqlsrv' => 'sqlsrv',
                'db_host_label' => 'Host',
                'db_host_placeholder' => 'Host...',
                'db_port_label' => 'Port',
                'db_port_placeholder' => 'Port...',
                'db_name_label' => 'Nazwa',
                'db_name_placeholder' => 'Nazwa bazy...',
                'db_username_label' => 'Użytkownik',
                'db_username_placeholder' => 'Użytkownik bazy...',
                'db_password_label' => 'Hasło',
                'db_password_placeholder' => 'Hasło...',

                'app_tabs' => [
                    'more_info' => 'More Info',
                    'broadcasting_title' => 'Broadcasting, Caching, Session, &amp; Queue',
                    'broadcasting_label' => 'Broadcast Driver',
                    'broadcasting_placeholder' => 'Broadcast Driver',
                    'cache_label' => 'Cache Driver',
                    'cache_placeholder' => 'Cache Driver',
                    'session_label' => 'Session Driver',
                    'session_placeholder' => 'Session Driver',
                    'queue_label' => 'Queue Driver',
                    'queue_placeholder' => 'Queue Driver',
                    'redis_label' => 'Redis Driver',
                    'redis_host' => 'Redis Host',
                    'redis_password' => 'Redis Password',
                    'redis_port' => 'Redis Port',

                    'mail_label' => 'Mail',
                    'mail_driver_label' => 'Mail Driver',
                    'mail_driver_placeholder' => 'Mail Driver',
                    'mail_host_label' => 'Mail Host',
                    'mail_host_placeholder' => 'Mail Host',
                    'mail_port_label' => 'Mail Port',
                    'mail_port_placeholder' => 'Mail Port',
                    'mail_username_label' => 'Mail Username',
                    'mail_username_placeholder' => 'Mail Username',
                    'mail_password_label' => 'Mail Password',
                    'mail_password_placeholder' => 'Mail Password',
                    'mail_encryption_label' => 'Mail Encryption',
                    'mail_encryption_placeholder' => 'Mail Encryption',

                    'pusher_label' => 'Pusher',
                    'pusher_app_id_label' => 'Pusher App Id',
                    'pusher_app_id_palceholder' => 'Pusher App Id',
                    'pusher_app_key_label' => 'Pusher App Key',
                    'pusher_app_key_palceholder' => 'Pusher App Key',
                    'pusher_app_secret_label' => 'Pusher App Secret',
                    'pusher_app_secret_palceholder' => 'Pusher App Secret',
                ],
                'buttons' => [
                    'install' => 'Instalacja',
                ],
            ],
        ]
    ],

    /*
     *
     * Final page translations.
     *
     */
    'final' => [
        'title' => 'Instalacja zakończona',
        'finished' => 'Aplikacja została poprawnie zainstalowana.',
        'exit' => 'Kliknij aby zakończyć',
    ],
];
