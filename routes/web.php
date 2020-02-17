<?php
Route::group(['prefix' => '/'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});



//Backoffice routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'access:ADMIN_VIEW'], function () {
    
    Route::get('/', function() {
        return view('admin.dashboard.index');
    })->name('dashboard.index');
    

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
