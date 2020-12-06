<?php
Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {

    //LOGS ROUTE
    Route::get('/logs', 'Admin\Modules\Logs\LogsController@index')->name('logs.index');

    //GENERAL SEETINGS ROUTE
    Route::get('/general', 'Admin\Modules\Settings\GeneralSettingsController@index')->name('general');
    Route::post('/general', 'Admin\Modules\Settings\GeneralSettingsController@store')->name('general.store');

    Route::get('/content', 'Admin\Modules\Settings\ContentSettingsController@index')->name('content');
    Route::post('/content', 'Admin\Modules\Settings\ContentSettingsController@store')->name('content.store');
});
