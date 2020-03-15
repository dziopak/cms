<?php
    // View hooks
    Hook::listen('template.post_left_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.posts.left', compact('langs'));
    });

    Hook::listen('template.post_right_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.posts.right', compact('langs'));
    });

    Hook::listen('template.post_bottom_content', function ($callback, $output, $variables) use ($langs) {
        return view('lang::partials.posts.bottom', compact('langs'));
    });

    //Resource hooks
    Hook::listen('apiPostResource', function ($callback, $output, $postResource, $post) use ($langs) {
        if (empty($output))
        {
          $output = $postResource;
        }
        
        foreach($langs as $lang) {
            $output['name_'.$lang->lang_tag] = $post['name_'.$lang->lang_tag];
            $output['slug_'.$lang->lang_tag] = $post['slug_'.$lang->lang_tag];
            $output['content_'.$lang->lang_tag] = $post['content_'.$lang->lang_tag];
            $output['excerpt_'.$lang->lang_tag] = $post['excerpt_'.$lang->lang_tag];
            $output['category_'.$lang->lang_tag] = $post->category['name_'.$lang->lang_tag];
            $output['category_slug_'.$lang->lang_tag] = $post->category['slug_'.$lang->lang_tag];
            $output['meta_title_'.$lang->lang_tag] = $post['meta_title_'.$lang->lang_tag];
            $output['meta_description_'.$lang->lang_tag] = $post['meta_description_'.$lang->lang_tag];
        }

        return $output;
    }, 10);
    
    Hook::listen('apiCategoryResource', function ($callback, $output, $categoryResource, $category) use ($langs) {
        if (empty($output))
        {
          $output = $categoryResource;
        }
        
        foreach($langs as $lang) {
            $output['name_'.$lang->lang_tag] = $category['name_'.$lang->lang_tag];
            $output['slug_'.$lang->lang_tag] = $category['slug_'.$lang->lang_tag];
            $output['description_'.$lang->lang_tag] = $category['description_'.$lang->lang_tag];
        }

        return $output;
    }, 10);
    

    //Validation hooks
    Hook::listen('apiPostsStoreValidation', function ($callback, $output, $validationFields) use ($langs) {
        empty($output) ? $output = $validationFields : null;

        foreach($langs as $lang) {
            $output['name_'.$lang->lang_tag] = 'required|string|max:255';
            $output['excerpt_'.$lang->lang_tag] = 'required|string|max:255';
            $output['slug_'.$lang->lang_tag] = 'required|string|max:255|unique:posts';
            $output['content_'.$lang->lang_tag] = 'required|string';
        }

        return $output;
    }, 10);

    Hook::listen('apiPostsUpdateValidation', function ($callback, $output, $validationFields) use ($langs) {
        empty($output) ? $output = $validationFields : null;

        foreach($langs as $lang) {
            $output['name_'.$lang->lang_tag] = 'string|max:255';
            $output['excerpt_'.$lang->lang_tag] = 'string|max:255';
            $output['slug_'.$lang->lang_tag] = 'string|max:255|unique:posts';
            $output['content_'.$lang->lang_tag] = 'string';
        }

        return $output;
    }, 10);
    

    // Other hooks
    Hook::listen('apiPostFindSelector', function ($callback, $output, $post, $slug) use ($langs) {
        empty($output) ? $output = $post : null;

        foreach($langs as $lang) {
            $output = $output->orWhere(['slug_'.$lang->lang_tag => $slug]);
        }

        return $output;
    }, 10);