<?php

use App\Http\Controllers\Admin;
Route::get('/_debugbar/assets/stylesheets', [
    'as' => 'debugbar-css',
    'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@css'
]);

Route::get('/_debugbar/assets/javascript', [
    'as' => 'debugbar-js',
    'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@js'
]);

Route::get('/_debugbar/open', [
    'as' => 'debugbar-open',
    'uses' => '\Barryvdh\Debugbar\Controllers\OpenController@handler'
]);

Route::group(['prefix' => '/'], function () {
    Route::get('/', function () {
        Artisan::call('storage:link');
    });
});

Route::get('/locale', LocaleController::class)->name('locale');

//Backoffice routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'access:ADMIN_VIEW'], function () {
    
    Route::get('/', 'admin\DashboardController@index')->name('dashboard.index');
    Route::post('/dashboard', 'admin\DashboardController@update')->name('dashboard.update');
    Route::get('/dashboard/widget', 'admin\DashboardController@getWidget')->name('dashboard.getwidget');
    
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
    
    //VENDOR ROUTES
    require base_path('routes/web/admin/vendor/filemanager.php');    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
