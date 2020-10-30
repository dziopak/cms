<?php

// Form hooks
Hook::listen('pageCategoriesFormFields', function ($callback, $output, $form) use ($langs) {
    empty($output) ? $output = $form : null;

    $output['left']['name_row']['items']['name']['container_class'] .= ' lang lang_origin';
    $output['left']['slug_category_row']['items']['slug']['container_class'] .= ' lang lang_origin';
    $output['left']['description_row']['items']['description']['container_class'] .= ' lang lang_origin';

    foreach ($langs as $lang) {
        $tag = $lang->lang_tag;

        // Name fields
        $name = addFormInput('name_' . $tag, 'text', 'admin/page_categories.name', true, null, '', 'hide lang', [], ['data-replace' => 'name']);
        $output['left']['name_row']['items'] = array_push_after('name', $name, $output['left']['name_row']['items']);

        // Slug fields
        $slug = addFormInput('slug_' . $tag, 'text', 'admin/page_categories.slug', true, null, '', 'hide lang', [], ['data-replace' => 'slug']);
        $output['left']['slug_category_row']['items'] = array_push_after('slug', $slug, $output['left']['slug_category_row']['items']);

        // Description fields
        $description = addFormInput('description_' . $tag, 'textarea', 'admin/page_categories.description', true, null, '', 'hide lang', [], ['data-replace' => 'description']);
        $output['left']['description_row']['items'] = array_push_after('description', $description, $output['left']['description_row']['items']);
    }
    return $output;
}, 10);


Hook::listen('postCategoriesFormFields', function ($callback, $output, $form) use ($langs) {
    empty($output) ? $output = $form : null;

    $output['left']['name_row']['items']['name']['container_class'] .= ' lang lang_origin';
    $output['left']['slug_category_row']['items']['slug']['container_class'] .= ' lang lang_origin';
    $output['left']['description_row']['items']['description']['container_class'] .= ' lang lang_origin';

    foreach ($langs as $lang) {
        $tag = $lang->lang_tag;

        // Name fields
        $name = addFormInput('name_' . $tag, 'text', 'admin/post_categories.name', true, null, '', 'hide lang', [], ['data-replace' => 'name']);
        $output['left']['name_row']['items'] = array_push_after('name', $name, $output['left']['name_row']['items']);

        // Slug fields
        $slug = addFormInput('slug_' . $tag, 'text', 'admin/post_categories.slug', true, null, '', 'hide lang', [], ['data-replace' => 'slug']);
        $output['left']['slug_category_row']['items'] = array_push_after('slug', $slug, $output['left']['slug_category_row']['items']);

        // Description fields
        $description = addFormInput('description_' . $tag, 'textarea', 'admin/post_categories.description', true, null, '', 'hide lang', [], ['data-replace' => 'description']);
        $output['left']['description_row']['items'] = array_push_after('description', $description, $output['left']['description_row']['items']);
    }
    return $output;
}, 10);


// Other hooks
Hook::listen('apiPageCategoriesStoreValidation', function ($callback, $output, $validationFields) use ($langs) {
    empty($output) ? $output = $validationFields : null;

    foreach ($langs as $lang) {
        $output['name_' . $lang->lang_tag] = 'required|string|max:255';
        $output['description_' . $lang->lang_tag] = 'required|string|max:255';
        $output['slug_' . $lang->lang_tag] = 'required|string|max:255|unique:pages';
    }

    return $output;
}, 10);


Hook::listen('apiPageCategoriesUpdateValidation', function ($callback, $output, $validationFields) use ($langs) {
    empty($output) ? $output = $validationFields : null;

    foreach ($langs as $lang) {
        $output['name_' . $lang->lang_tag] = 'string|max:255';
        $output['description_' . $lang->lang_tag] = 'string|max:255';
        $output['slug_' . $lang->lang_tag] = 'string|max:255|unique:pages';
    }

    return $output;
}, 10);

Hook::listen('adminPostCategoriesValidation', function ($callback, $output, $validationFields) use ($langs) {
    empty($output) ? $output = $validationFields : null;

    foreach ($langs as $lang) {
        $output['name_' . $lang->lang_tag] = 'string|max:255';
        $output['description_' . $lang->lang_tag] = 'string|max:255';
        $output['slug_' . $lang->lang_tag] = 'string|max:255|unique:posts';
    }

    return $output;
}, 10);

Hook::listen('adminPageCategoriesValidation', function ($callback, $output, $validationFields) use ($langs) {
    empty($output) ? $output = $validationFields : null;

    foreach ($langs as $lang) {
        $output['name_' . $lang->lang_tag] = 'string|max:255';
        $output['description_' . $lang->lang_tag] = 'string|max:255';
        $output['slug_' . $lang->lang_tag] = 'string|max:255|unique:pages';
    }

    return $output;
}, 10);




Hook::listen('apiPageCategoriesFindSelector', function ($callback, $output, $category, $slug) use ($langs) {
    empty($output) ? $output = $category : null;

    foreach ($langs as $lang) {
        $output = $output->orWhere(['slug_' . $lang->lang_tag => $slug]);
    }

    return $output;
}, 10);


Hook::listen('apiPostCategoriesStoreValidation', function ($callback, $output, $validationFields) use ($langs) {
    empty($output) ? $output = $validationFields : null;

    foreach ($langs as $lang) {
        $output['name_' . $lang->lang_tag] = 'required|string|max:255';
        $output['description_' . $lang->lang_tag] = 'required|string|max:255';
        $output['slug_' . $lang->lang_tag] = 'required|string|max:255|unique:posts';
    }

    return $output;
}, 10);


Hook::listen('apiPostCategoriesUpdateValidation', function ($callback, $output, $validationFields) use ($langs) {
    empty($output) ? $output = $validationFields : null;

    foreach ($langs as $lang) {
        $output['name_' . $lang->lang_tag] = 'string|max:255';
        $output['description_' . $lang->lang_tag] = 'string|max:255';
        $output['slug_' . $lang->lang_tag] = 'string|max:255|unique:posts';
    }

    return $output;
}, 10);


Hook::listen('apiPostCategoriesFindSelector', function ($callback, $output, $category, $slug) use ($langs) {
    empty($output) ? $output = $category : null;

    foreach ($langs as $lang) {
        $output = $output->orWhere(['slug_' . $lang->lang_tag => $slug]);
    }

    return $output;
}, 10);
