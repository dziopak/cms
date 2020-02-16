<?php
Route::group(['prefix' => 'admin/settings', 'as' => 'admin.settings.'], function ()  {
        
    ///////////////
    //Logs routes//
    ///////////////
    Route::get('/logs', 'LogsController@index')->name('logs.index');
    
});
