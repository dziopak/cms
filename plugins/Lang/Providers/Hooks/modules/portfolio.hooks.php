<?php

    // Form hooks
    Hook::listen('modulePortfolioFormFields', function ($callback, $output, $form) use ($langs) {
        empty($output) ? $output = $form : null;

        // $output['basic_data']['name_row']['items']['name']['container_class'] .= ' lang lang_origin';
        // $output['basic_data']['slug_category_row']['items']['slug']['container_class'] .= ' lang lang_origin';

        $output['project_content']['intro_row']['items']['intro']['container_class'] .= ' lang lang_origin';
        $output['project_content']['description_row']['items']['description']['container_class'] .= ' lang lang_origin';

        foreach($langs as $lang) {
            $tag = $lang->lang_tag;

            // Name fields
            // $name = addFormInput('name_'.$tag, 'text', 'portfolio::langs.name', true, null, '', 'hide lang', [], ['data-replace' => 'name']);
            // $output['basic_data']['name_row']['items'] = array_push_after('name', $name, $output['basic_data']['name_row']['items']);
            
            // Slug fields
            // $slug = addFormInput('slug_'.$tag, 'text', 'portfolio::langs.slug', true, null, '', 'hide lang', [], ['data-replace' => 'slug']);
            // $output['basic_data']['slug_category_row']['items'] = array_push_after('slug', $slug, $output['basic_data']['slug_category_row']['items']);
            
            // Intro fields
            $intro = addFormInput('intro_'.$tag, 'textarea', 'portfolio::langs.intro', true, null, '', 'hide lang', [], ['data-replace' => 'intro']);
            $output['project_content']['intro_row']['items'] = array_push_after('intro', $intro, $output['project_content']['intro_row']['items']);
        
            // Description fields
            $description = addFormInput('description_'.$tag, 'textarea', 'portfolio::langs.description', true, null, '', 'hide lang', [], ['data-replace' => 'description']);
            $output['project_content']['description_row']['items'] = array_push_after('description', $description, $output['project_content']['description_row']['items']);
            
        }
        return $output;
    }, 10);