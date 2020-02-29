<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'admin/modules/lang', 'as' => 'admin.modules.lang.', 'middleware' => 'access:ADMIN_VIEW'], function () {
    Route::post('/', 'LangController@store')->name('store');
    Route::get('/', 'LangController@index')->name('index');
    Route::post('/setlang', 'LangController@setlang')->name('setlang');
    Route::get('/create', 'LangController@create')->name('create');
    Route::get('/{id}/edit', 'LangController@edit')->name('edit');
    Route::get('/{id}/delete', 'LangController@delete')->name('delete');
    Route::delete('/{id}', 'LangController@destroy')->name('destroy');
    Route::patch('/{id}', 'LangController@update')->name('update');
});
