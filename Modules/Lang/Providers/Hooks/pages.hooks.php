<?php
    Hook::listen('template.page_left_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.pages.left', compact('langs'));
    });

    Hook::listen('template.page_right_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.pages.right', compact('langs'));
    });

    Hook::listen('template.page_bottom_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.pages.bottom', compact('langs'));
    });


    //Validation hooks
    Hook::listen('apiPagesStoreValidation', function ($callback, $output, $validationFields) use ($langs) {
        empty($output) ? $output = $validationFields : null;

        foreach($langs as $lang) {
            $output['name_'.$lang->lang_tag] = 'required|string|max:255';
            $output['excerpt_'.$lang->lang_tag] = 'required|string|max:255';
            $output['slug_'.$lang->lang_tag] = 'required|string|max:255|unique:pages';
            $output['content_'.$lang->lang_tag] = 'required|string';
        }

        return $output;
    }, 10);
    
    Hook::listen('apiPagesUpdateValidation', function ($callback, $output, $validationFields) use ($langs) {
        empty($output) ? $output = $validationFields : null;

        foreach($langs as $lang) {
            $output['name_'.$lang->lang_tag] = 'string|max:255';
            $output['excerpt_'.$lang->lang_tag] = 'string|max:255';
            $output['slug_'.$lang->lang_tag] = 'string|max:255|unique:pages';
            $output['content_'.$lang->lang_tag] = 'string';
        }

        return $output;
    }, 10);