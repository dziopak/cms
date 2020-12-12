<?php

$langs = $this->langs;

Hook::addfilter('sources.components.sidebar', function ($form) {
    $form['settings']['items']['lang'] = [
        'route' => 'Lang::index',
        'custom_label' => __('Lang::messages.sidebar_title')
    ];

    return $form;
});


Hook::addAction('template.admin.styles', function () {
    echo '<link href="/css/lang/lang.css" rel="stylesheet">';
});


Hook::addAction('template.admin.scripts.body', function () {
    echo '<script src="/js/lang/lang.js"></script>';
});


Hook::addAction('template.admin.scripts.inline', function () use ($langs) {
    $inputs = '';

    // Create lang switchers
    foreach ($langs as $lang) {
        $inputs .= '<div style="background-image: url(\'/images/langs/flags/' . $lang->lang_tag . '.png\');" class="input-lang" data-lang="' . $lang->lang_tag . '"></div>';
    }

    // Generate HTML
    $html = '<div class="input-lang-switcher">
        <div class="input-lang active" style="background-image: url(\'/images/langs/flags/en.png\');" data-lang="default"></div>'
        . $inputs .
        '</div>';

    // Generate JS
    $script = '
        $(document).ready(function() {
            var fields = $(".lang_origin");

            if (fields.length > 0) {
                fields.each(function() {
                    $(this).append(`' . $html . '`);
                });
            }
        });
    ';

    echo $script;
});
