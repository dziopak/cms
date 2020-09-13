<?php

// Form hooks

use App\Http\Utilities\Admin\PluginUtilities;

Hook::listen('pluginPortfolioFormFields', function ($callback, $output, $form) use ($langs) {

    empty($output) ? $output = $form : null;

    $output['project_content']['intro_row']['items']['intro']['container_class'] .= ' lang lang_origin';
    $output['project_content']['description_row']['items']['description']['container_class'] .= ' lang lang_origin';

    foreach ($langs as $lang) {
        $tag = $lang->lang_tag;

        // Intro fields
        $intro = addFormInput('intro_' . $tag, 'textarea', 'portfolio::langs.intro', true, null, '', 'hide lang', [], ['data-replace' => 'intro']);
        $output['project_content']['intro_row']['items'] = array_push_after('intro', $intro, $output['project_content']['intro_row']['items']);

        // Description fields
        $description = addFormInput('description_' . $tag, 'textarea', 'portfolio::langs.description', true, null, '', 'hide lang', [], ['data-replace' => 'description']);
        $output['project_content']['description_row']['items'] = array_push_after('description', $description, $output['project_content']['description_row']['items']);
    }
    return $output;
}, PluginUtilities::getID('lang'));


// Resource Hooks
Hook::listen('pluginPortfolioItemResource', function ($callback, $output, $fields, $model) use ($langs) {
    empty($output) ? $output = $fields : null;

    foreach ($langs as $lang) {
        $tag = $lang->lang_tag;

        $output['intro_' . $tag] = $model['intro_' . $tag];
        $output['description_' . $tag] = $model['description_' . $tag];
    }

    return $output;
}, PluginUtilities::getID('lang'));
