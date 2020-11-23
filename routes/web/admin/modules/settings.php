<?php
Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {

    //LOGS ROUTE
    Route::get('/logs', 'Admin\Modules\LogsController@index')->name('logs.index');

    //GENERAL SEETINGS ROUTE
    Route::get('/general', 'Admin\Modules\GeneralSettingsController@index')->name('general');
    Route::post('/general', 'Admin\Modules\GeneralSettingsController@store')->name('general.store');

    Route::get('/content', 'Admin\Modules\ContentSettingsController@index')->name('content');
    Route::post('/content', 'Admin\Modules\ContentSettingsController@store')->name('content.store');
});
