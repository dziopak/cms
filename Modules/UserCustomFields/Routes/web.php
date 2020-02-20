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
Route::group(['prefix' => 'admin/modules', 'as' => 'admin.modules.usercustomfields.', 'middleware' => 'access:ADMIN_VIEW'], function () {
    Route::prefix('usercustomfields')->group(function() {
        Route::resource('/', 'UserCustomFieldsController');
    });
});