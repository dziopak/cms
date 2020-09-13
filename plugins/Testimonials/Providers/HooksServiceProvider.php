<?php

namespace Plugins\Testimonials\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Utilities\Admin\PluginUtilities;
use plugins\Testimonials\Entities\Testimonial;
use plugins\Testimonials\Transformers\TestimonialResource;
use Hook;
use Lang;

class HooksServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Sidebar hook
        Hook::listen('adminSidebarItems', function ($callback, $output, $items) {
            if (empty($output)) $output = $items;
            $output = array_push_after('media', [
                'testimonials' => [
                    'class' => 'icon fa fas fa-quote-left',
                    'route' => 'admin.plugins.testimonials.index',
                    'items' => [
                        'list' => [
                            'route' => 'admin.plugins.testimonials.index',
                            'custom_label' => Lang::get('portfolio::langs.list_items'),
                        ],

                        'create' => [
                            'route' => 'admin.plugins.testimonials.create',
                            'custom_label' => Lang::get('portfolio::langs.create_item')
                        ],
                    ]
                ]
            ], $output);
            return $output;
        }, PluginUtilities::getID('testimonials'));


        Hook::listen('pluginPortfolioFormFields', function ($callback, $output, $items) {
            if (empty($output)) $output = $items;

            $testimonials = Testimonial::all('id', 'author')->pluck('author', 'id')->toArray();
            $output['basic_data'] = array_push_after('slug_category_row', [
                'testimonial_row' => [
                    'class' => 'form-group row',
                    'items' => [
                        'testimonial_id' => [
                            'type' => 'select',
                            'options' => array_merge([0 => 'None'], $testimonials),
                            'label' => 'Testimonial',
                            'required' => true,
                            'value' => null,
                            'class' => '',
                            'container_class' => ''
                        ],
                    ],
                ]
            ], $output['basic_data']);

            return $output;
        }, PluginUtilities::getID('testimonials'));


        Hook::listen('pluginPortfolioItemResource', function ($callback, $output, $fields, $model) {
            if (empty($output)) $output = $fields;

            $output['testimonial'] = new TestimonialResource($model->testimonial);

            return $output;
        }, PluginUtilities::getID('testimonials'));
    }
}
