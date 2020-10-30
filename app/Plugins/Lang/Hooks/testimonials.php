<?php

use App\Http\Utilities\Admin\PluginUtilities;

// Hook::listen('pluginTestimonialsFormFields', function ($callback, $output, $form) use ($langs) {
//     empty($output) ? $output = $form : null;

//     $output['basic_data']['author_row']['items']['author_title']['container_class'] .= ' lang lang_origin';
//     $output['basic_data']['content_row']['items']['content']['container_class'] .= ' lang lang_origin';

//     foreach ($langs as $lang) {
//         $tag = $lang->lang_tag;

//         // Name fields
//         $author_title = addFormInput('author_title_' . $tag, 'text', 'Author\'s title', true, null, '', 'hide lang', [], ['data-replace' => 'author_title']);
//         $output['basic_data']['author_row']['items'] = array_push_after('author_title', $author_title, $output['basic_data']['author_row']['items']);

//         // Name fields
//         $content = addFormInput('content_' . $tag, 'textarea', 'Content', true, null, '', 'hide lang', [], ['data-replace' => 'content']);
//         $output['basic_data']['content_row']['items'] = array_push_after('content', $content, $output['basic_data']['content_row']['items']);
//     }
//     return $output;
// }, PluginUtilities::getID('lang'));

// Hook::listen('pluginTestimonialResource', function ($callback, $output, $fields, $model) use ($langs) {
//     empty($output) ? $output = $fields : null;

//     foreach ($langs as $lang) {
//         $tag = $lang->lang_tag;

//         $output = array_merge($output, [
//             'author_title_' . $tag => $model['author_title_' . $tag],
//             'content_' . $tag => $model['content_' . $tag],
//         ]);

//         return $output;
//     }
// }, PluginUtilities::getID('lang'));
