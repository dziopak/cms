<?php

Route::group(['prefix' => 'admin/modules/testimonials', 'as' => 'admin.modules.testimonials.', 'middleware' => 'access:ADMIN_VIEW'], function () {
    Route::get('/', 'TestimonialsController@index')->name('index');
    Route::get('/create', 'TestimonialsController@create')->name('create');
    Route::post('/store', 'TestimonialsController@store')->name('store');
    Route::patch('/{id}/', 'TestimonialsController@update')->name('update');
    Route::get('/{id}/edit', 'TestimonialsController@edit')->name('edit');
    Route::get('/{id}/delete', 'TestimonialsController@delete')->name('delete');
});
