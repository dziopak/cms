<?php

Route::group(['prefix' => 'install', 'as' => 'LaravelInstaller::', 'middleware' => ['web', 'install']], function () {
    Route::get('setup', [
        'as' => 'setup',
        'uses' => 'Installer\RequirementsController@setup',
    ]);
    Route::get('requirements', [
        'as' => 'requirements',
        'uses' => 'Installer\RequirementsController@requirements',
    ]);
    Route::get('database/', [
        'as' => 'database',
        'uses' => 'Installer\DatabaseController@db',
    ]);
});
