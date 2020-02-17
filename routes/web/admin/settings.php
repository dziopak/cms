<?php
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function ()  {

            //LOGS ROUTES
            Route::get('/logs', 'LogsController@index')->name('logs.index');

    });
?>