<?php

use App\Http\Utilities\Admin\PluginUtilities;

PluginUtilities::registerRoutes('lang');
Route::group(['prefix' => 'admin/plugins/lang', 'as' => 'admin.plugins.lang.', 'middleware' => 'access:ADMIN_VIEW'], function () {
    Route::post('/', 'LangController@store')->name('store');
    Route::post('/setlang', 'LangController@setlang')->name('setlang');
    Route::get('/create', 'LangController@create')->name('create');
    Route::get('/{id}/edit', 'LangController@edit')->name('edit');
    Route::get('/{id}/delete', 'LangController@delete')->name('delete');
    Route::delete('/{id}', 'LangController@destroy')->name('destroy');
    Route::patch('/{id}', 'LangController@update')->name('update');
});
