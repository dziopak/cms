<?php

$langs = $this->langs;

// Form hooks
Hook::addfilter('page.sources.form', function ($form) use ($langs) {
    $form['right']['name_row']['items']['name']['container_class'] .= ' lang lang_origin';
    $form['right']['slug_category_row']['items']['slug']['container_class'] .= ' lang lang_origin';
    $form['right']['excerpt_row']['items']['excerpt']['container_class'] .= ' lang lang_origin';
    $form['left']['content_row']['items']['content']['container_class'] .= ' lang lang_origin';
    $form['seo']['meta_title_row']['items']['meta_title']['container_class'] .= ' lang lang_origin';
    $form['seo']['meta_description_row']['items']['meta_description']['container_class'] .= ' lang lang_origin';

    foreach ($langs as $lang) {
        $tag = $lang->lang_tag;

        // Name fields
        $name = addFormInput('name_' . $tag, 'text', 'admin/pages.name', true, null, '', 'hide lang', [], ['data-replace' => 'name']);
        $form['right']['name_row']['items'] = array_push_after('name', $name, $form['right']['name_row']['items']);

        // Slug fields
        $slug = addFormInput('slug_' . $tag, 'text', 'admin/pages.slug', true, null, '', 'hide lang', [], ['data-replace' => 'slug']);
        $form['right']['slug_category_row']['items'] = array_push_after('slug', $slug, $form['right']['slug_category_row']['items']);

        // Excerpt fields
        $excerpt = addFormInput('excerpt_' . $tag, 'textarea', 'admin/pages.excerpt', true, null, '', 'hide lang', [], ['data-replace' => 'excerpt']);
        $form['right']['excerpt_row']['items'] = array_push_after('excerpt', $excerpt, $form['right']['excerpt_row']['items']);

        // Content fields
        $content = addFormInput('content_' . $tag, 'textarea', 'admin/pages.content', true, null, 'tinymce', 'hide lang', [], ['data-replace' => 'content']);
        $form['left']['content_row']['items'] = array_push_after('content', $content, $form['left']['content_row']['items']);

        // Meta title fields
        $meta_title = addFormInput('meta_title_' . $tag, 'text', 'admin/pages.meta_title', false, null, '', 'hide lang', [], ['data-replace' => 'meta_title']);
        $form['seo']['meta_title_row']['items'] = array_push_after('meta_title', $meta_title, $form['seo']['meta_title_row']['items']);

        // Meta description fields
        $meta_description = addFormInput('meta_description_' . $tag, 'textarea', 'admin/pages.meta_description', false, null, '', 'hide lang', [], ['data-replace' => 'meta_description']);
        $form['seo']['meta_description_row']['items'] = array_push_after('meta_description', $meta_description, $form['seo']['meta_description_row']['items']);
    }

    return $form;
});

Hook::addfilter('page.entity.getName', function ($name, $attributes) {
    return lang($attributes, 'name');
}, 20, 2);

Hook::addfilter('page.entity.getExcerpt', function ($excerpt, $attributes) {
    return lang($attributes, 'excerpt');
}, 20, 2);

Hook::addfilter('page.entity.getContent', function ($content, $attributes) {
    return lang($attributes, 'content');
}, 20, 2);

Hook::addfilter('page.entity.getMetaTitle', function ($title, $attributes) {
    return lang($attributes, 'meta_title');
}, 20, 2);

Hook::addfilter('page.entity.getMetaDescription', function ($description, $attributes) {
    return lang($attributes, 'meta_description');
}, 20, 2);
