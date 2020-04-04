<?php
Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {

    //LOGS ROUTE
    Route::get('/logs', 'admin\LogsController@index')->name('logs.index');

    //GENERAL SEETINGS ROUTE
    Route::get('/general', 'admin\GeneralSettingsController@index')->name('general.index');
    Route::post('/general', 'admin\GeneralSettingsController@store')->name('general.store');
});
