<?php

Route::group(['prefix' => 'install', 'as' => 'LaravelInstaller::', 'middleware' => ['web', 'install']], function () {
    Route::get('setup', [
        'as' => 'setup',
        'uses' => 'InstallerRequirementsController@setup',
    ]);
    Route::get('requirements', [
        'as' => 'requirements',
        'uses' => 'InstallerRequirementsController@requirements',
    ]);
    Route::get('database/', [
        'as' => 'database',
        'uses' => 'InstallerDatabaseController@db',
    ]);
});
