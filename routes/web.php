<?php

//Front-office routes
Route::group(['as' => 'front.'], function () {
    Route::get('/', 'front\PostsController@index')->name('posts.index');
});


//Back-office routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'access:ADMIN_VIEW'], function () {

    Route::get('/', 'admin\DashboardController@index')->name('dashboard.index');
    Route::post('/dashboard', 'admin\DashboardController@update')->name('dashboard.update');
    Route::get('/dashboard/widget', 'admin\DashboardController@getWidget')->name('dashboard.getwidget');
    Route::get('/layouts/widget', 'admin\LayoutsController@getBlock')->name('layouts.getwidget');

    Route::get('/menus', function () {
        return view('admin.menus.index');
    })->name('menus.index');


    Route::get('/modules', 'admin\ModulesController@index')->name('modules.index');

    //POSTS ROUTES
    require base_path('routes/web/admin/users.php');

    //POSTS ROUTES
    require base_path('routes/web/admin/posts.php');

    //PAGES ROUTES
    require base_path('routes/web/admin/pages.php');

    //SETTINGS ROUTES
    require base_path('routes/web/admin/settings.php');

    //VENDOR ROUTES
    require base_path('routes/web/admin/vendor/filemanager.php');
});

//HELPERS ROUTES
require base_path('routes/web/admin/helpers.php');
