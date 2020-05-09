<?php

Route::get('/module', 'Admin\ModuleDownloadController@download');

//Back-office routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'access:ADMIN_VIEW'], function () {

    Route::get('/', 'admin\DashboardController@index')->name('dashboard.index');
    Route::post('/dashboard', 'admin\DashboardController@update')->name('dashboard.update');
    Route::get('/dashboard/widget', 'admin\DashboardController@getWidget')->name('dashboard.getwidget');
    Route::get('/layouts/widget', 'admin\LayoutsController@getBlock')->name('layouts.getwidget');

    Route::get('/menus', function () {
        return view('admin.menus.index');
    })->name('widgets.menus.index');


    Route::get('/plugins', 'admin\PluginsController@index')->name('plugins.index');

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
});
