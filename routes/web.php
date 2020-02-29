<?php
Route::group(['prefix' => '/'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});



//Backoffice routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'access:ADMIN_VIEW'], function () {
    
    Route::get('/', 'admin\DashboardController@index')->name('dashboard.index');
    Route::get('/dashboard', 'admin\DashboardController@edit')->name('dashboard.edit');
    Route::patch('/dashboard', 'admin\DashboardController@update')->name('dashboard.update');
    
    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        return redirect(route('admin.dashboard.index'));
    });

    Route::get('/menus', function() {
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
    
    //FILE MANAGER ROUTES
    require base_path('routes/web/admin/filemanager.php');    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
