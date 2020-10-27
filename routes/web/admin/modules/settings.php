<?php
Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {

    //LOGS ROUTE
    Route::get('/logs', 'Admin\Modules\LogsController@index')->name('logs.index');

    //GENERAL SEETINGS ROUTE
    Route::get('/general', 'Admin\Modules\SettingsController@index')->name('general.index');
    Route::post('/general', 'Admin\Modules\SettingsController@store')->name('general.store');
});
