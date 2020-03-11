<?php
    Hook::listen('template.category_left_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.categories.left', compact('langs'));
    });

    Hook::listen('apiPostCategoriesStoreValidation', function ($callback, $output, $validationFields) use ($langs) {
        empty($output) ? $output = $validationFields : null;

        foreach($langs as $lang) {
            $output['name_'.$lang->lang_tag] = 'required|string|max:255';
            $output['description_'.$lang->lang_tag] = 'required|string|max:255';
            $output['slug_'.$lang->lang_tag] = 'required|string|max:255|unique:posts';
        }

        return $output;
    }, 10);


    Hook::listen('apiPostCategoriesUpdateValidation', function ($callback, $output, $validationFields) use ($langs) {
        empty($output) ? $output = $validationFields : null;

        foreach($langs as $lang) {
            $output['name_'.$lang->lang_tag] = 'string|max:255';
            $output['description_'.$lang->lang_tag] = 'string|max:255';
            $output['slug_'.$lang->lang_tag] = 'string|max:255|unique:posts';
        }

        return $output;
    }, 10);


    Hook::listen('apiPostCategoriesFindSelector', function ($callback, $output, $category, $slug) use ($langs) {
        empty($output) ? $output = $category : null;

        foreach($langs as $lang) {
            $output = $output->orWhere(['slug_'.$lang->lang_tag => $slug]);
        }

        return $output;
    }, 10);