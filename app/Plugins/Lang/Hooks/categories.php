<?php

$langs = $this->langs;

// Form hooks
Eventy::addfilter('category.sources.form', function ($form) use ($langs) {
    $form['left']['name_row']['items']['name']['container_class'] .= ' lang lang_origin';
    $form['left']['slug_category_row']['items']['slug']['container_class'] .= ' lang lang_origin';
    $form['left']['description_row']['items']['description']['container_class'] .= ' lang lang_origin';

    foreach ($langs as $lang) {
        $tag = $lang->lang_tag;

        // Name fields
        $name = addFormInput('name_' . $tag, 'text', 'admin/page_categories.name', true, null, '', 'hide lang', [], ['data-replace' => 'name']);
        $form['left']['name_row']['items'] = array_push_after('name', $name, $form['left']['name_row']['items']);

        // Slug fields
        $slug = addFormInput('slug_' . $tag, 'text', 'admin/page_categories.slug', true, null, '', 'hide lang', [], ['data-replace' => 'slug']);
        $form['left']['slug_category_row']['items'] = array_push_after('slug', $slug, $form['left']['slug_category_row']['items']);

        // Description fields
        $description = addFormInput('description_' . $tag, 'textarea', 'admin/page_categories.description', true, null, '', 'hide lang', [], ['data-replace' => 'description']);
        $form['left']['description_row']['items'] = array_push_after('description', $description, $form['left']['description_row']['items']);
    }

    return $form;
});
