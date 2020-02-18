<?php
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function ()  {

            //LOGS ROUTES
            Route::get('/logs', 'admin\LogsController@index')->name('logs.index');

    });
?>