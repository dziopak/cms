<?php

$form = [
    'basic_data' => [
        'site_title_row' => [
            'class' => 'form-group row',
            'items' => [
                'title' => [
                    'type' => 'text',
                    'label' => __('admin/settings.general.title'),
                    'required' => true,
                    'value' => config('global')['general']['title'] ?? "",
                    'class' => ''
                ],
            ],
        ],
        'site_description_row' => [
            'class' => 'form-group row',
            'items' => [
                'description' => [
                    'type' => 'textarea',
                    'label' => __('admin/settings.general.description'),
                    'required' => true,
                    'value' => config('global')['general']['description'] ?? "",
                    'class' => 'small'
                ],
            ]
        ],
        'language_row' => [
            'class' => 'form-group row mt-5',
            'items' => [
                'lang' => [
                    'type' => 'select',
                    'label' => __('admin/settings.general.lang'),
                    'required' => true,
                    'value' => config('global')['general']['lang'] ?? "",
                    'class' => 'small',
                    'options' => config('app.langs')
                ],
            ]
        ],
        'theme_row' => [
            'class' => 'form-group row',
            'items' => [
                'theme' => [
                    'type' => 'select',
                    'label' => __('admin/settings.general.theme'),
                    'required' => true,
                    'value' => config('global')['general']['theme'] ?? "",
                    'class' => 'small',
                    'options' => $args['themes']
                ],
            ]
        ],
        'layouts_row' => [
            'class' => 'form-group row',
            'items' => [
                'layout' => [
                    'type' => 'select',
                    'label' => __('admin/settings.general.layout'),
                    'required' => true,
                    'value' => config('global')['general']['layout'] ?? "",
                    'class' => 'small',
                    'options' => $args['layouts']
                ]
            ]
        ],
    ],
];

return Eventy::filter('settings.general.sources.form', $form);
