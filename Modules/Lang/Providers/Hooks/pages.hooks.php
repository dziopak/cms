<?php
    // Form hooks
    Hook::listen('pagesFormFields', function ($callback, $output, $form) use ($langs) {
        empty($output) ? $output = $form : null;

        $output['left']['name_row']['items']['name']['container_class'] .= ' lang lang_origin';
        $output['left']['slug_category_row']['items']['slug']['container_class'] .= ' lang lang_origin';
        $output['left']['excerpt_row']['items']['excerpt']['container_class'] .= ' lang lang_origin';
        $output['bottom']['content_row']['items']['content']['container_class'] .= ' lang lang_origin';
        $output['right']['meta_title_row']['items']['meta_title']['container_class'] .= ' lang lang_origin';
        $output['right']['meta_description_row']['items']['meta_description']['container_class'] .= ' lang lang_origin';

        foreach($langs as $lang) {
            $tag = $lang->lang_tag;

            // Name fields
            $name = addFormInput('name_'.$tag, 'text', 'admin/pages.name', true, null, '', 'hide lang', [], ['data-replace' => 'name']);
            $output['left']['name_row']['items'] = array_push_after('name', $name, $output['left']['name_row']['items']);
            
            // Slug fields
            $slug = addFormInput('slug_'.$tag, 'text', 'admin/pages.slug', true, null, '', 'hide lang', [], ['data-replace' => 'slug']);
            $output['left']['slug_category_row']['items'] = array_push_after('slug', $slug, $output['left']['slug_category_row']['items']);

            // Excerpt fields
            $excerpt = addFormInput('excerpt_'.$tag, 'textarea', 'admin/pages.excerpt', true, null, '', 'hide lang', [], ['data-replace' => 'excerpt']);
            $output['left']['excerpt_row']['items'] = array_push_after('excerpt', $excerpt, $output['left']['excerpt_row']['items']);
            
            // Content fields
            $content = addFormInput('content_'.$tag, 'textarea', 'admin/pages.content', true, null, 'tinymce', 'hide lang', [], ['data-replace' => 'content']);
            $output['bottom']['content_row']['items'] = array_push_after('content', $content, $output['bottom']['content_row']['items']);
            
            // Meta title fields
            $meta_title = addFormInput('meta_title_'.$tag, 'text', 'admin/pages.meta_title', false, null, '', 'hide lang', [], ['data-replace' => 'meta_title']);
            $output['right']['meta_title_row']['items'] = array_push_after('meta_title', $meta_title, $output['right']['meta_title_row']['items']);
            
            // Meta description fields
            $meta_description = addFormInput('meta_description_'.$tag, 'textarea', 'admin/pages.meta_description', false, null, '', 'hide lang', [], ['data-replace' => 'meta_description']);
            $output['right']['meta_description_row']['items'] = array_push_after('meta_description', $meta_description, $output['right']['meta_description_row']['items']);

        }
        return $output;
    }, 10);


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
    
    Hook::listen('adminPagesValidation', function ($callback, $output, $validationFields) use ($langs) {
        empty($output) ? $output = $validationFields : null;

        foreach($langs as $lang) {
            $output['name_'.$lang->lang_tag] = 'string|max:255';
            $output['excerpt_'.$lang->lang_tag] = 'string|max:255';
            $output['slug_'.$lang->lang_tag] = 'string|max:255|unique:pages';
            $output['content_'.$lang->lang_tag] = 'string';
        }

        return $output;
    }, 10);


    //Other hooks
    Hook::listen('apiPageFindSelector', function ($callback, $output, $page, $slug) use ($langs) {
        empty($output) ? $output = $page : null;

        foreach($langs as $lang) {
            $output = $output->orWhere(['slug_'.$lang->lang_tag => $slug]);
        }

        return $output;
    }, 10);


    