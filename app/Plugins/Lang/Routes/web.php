<?php

Route::group(['prefix' => 'admin/plugins/lang', 'middleware' => 'access:ADMIN_VIEW'], function () {

    Route::get('/', 'LangsController@index')->name('index');

    Route::get('/create', 'LangsController@create')->name('create');
    Route::post('/', 'LangsController@store')->name('store');

    Route::get('/{lang_id}/edit', 'LangsController@edit')->name('edit');
    Route::patch('/{id}/', 'LangsController@update')->name('update');

    Route::get('/{id}/delete', 'LangsController@delete')->name('delete');
    Route::delete('/{id}', 'LangsController@destroy')->name('destroy');

    Route::post('/setlang', 'LangsController@setlang')->name('setlang');
});
