<?php

use App\Http\Utilities\Admin\PluginUtilities;

PluginUtilities::registerRoutes('testimonials');
Route::group(['prefix' => 'admin/plugins/testimonials', 'as' => 'admin.plugins.testimonials.', 'middleware' => 'access:ADMIN_VIEW'], function () {
    Route::get('/create', 'TestimonialsController@create')->name('create');
    Route::post('/store', 'TestimonialsController@store')->name('store');
    Route::patch('/{id}/', 'TestimonialsController@update')->name('update');
    Route::get('/{id}/edit', 'TestimonialsController@edit')->name('edit');
    Route::get('/{id}/delete', 'TestimonialsController@delete')->name('delete');
});
