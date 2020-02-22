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
Route::group(['prefix' => 'admin/modules/usercustomfields', 'as' => 'admin.modules.usercustomfields.', 'middleware' => 'access:ADMIN_VIEW'], function () {
    Route::get('/', 'UserCustomFieldsController@index')->name('index');
    Route::get('/create', 'UserCustomFieldsController@create')->name('create');
    Route::post('/', 'UserCustomFieldsController@store')->name('store');
    Route::get('/{id}/edit', 'UserCustomFieldsController@edit')->name('edit');
    Route::put('/{id}', 'UserCustomFieldsController@update')->name('update');
});