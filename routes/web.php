<?php

Route::get('/module', 'Admin\ModuleDownloadController@download');

//Back-office routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'access:ADMIN_VIEW'], function () {
    //DASHBOARD ROUTES
    require base_path('routes/web/admin/dashboard.php');

    //USERS ROUTES
    require base_path('routes/web/admin/users.php');

    //POSTS ROUTES
    require base_path('routes/web/admin/posts.php');

    //PAGES ROUTES
    require base_path('routes/web/admin/pages.php');

    //MEDIA ROUTES
    require base_path('routes/web/admin/media.php');

    //SETTINGS ROUTES
    require base_path('routes/web/admin/settings.php');

    //BLOCKS ROUTES
    require base_path('routes/web/admin/blocks.php');

    //VENDOR ROUTES
    require base_path('routes/web/admin/vendor/filemanager.php');

    Route::get('/menus', function () {
        return view('admin.menus.index');
    })->name('widgets.menus.index');


    Route::get('/plugins', 'Admin\Modules\PluginsController@index')->name('plugins.index');
});

//HELPERS ROUTES
require base_path('routes/web/admin/helpers.php');


//Front-office routes
Route::group(['as' => 'front.'], function () {
    //POSTS ROUTES
    require base_path('routes/web/front/posts.php');

    //PAGES ROUTES
    require base_path('routes/web/front/pages.php');
});

Route::group(['prefix' => 'install', 'as' => 'LaravelInstaller::', 'middleware' => ['web', 'install']], function () {
    Route::get('setup', [
        'as' => 'setup',
        'uses' => 'InstallerRequirementsController@setup',
    ]);
    Route::get('requirements', [
        'as' => 'requirements',
        'uses' => 'InstallerRequirementsController@requirements',
    ]);
    Route::get('database/{locale}/', [
        'as' => 'database',
        'uses' => 'InstallerDatabaseController@db',
    ]);
});
