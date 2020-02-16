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
    

    ////////////////
    //Users routes//
    ////////////////
        Route::resource('/users', 'AdminUsersController')->except('show');
        Route::get('/{user_id}/delete', 'AdminUsersController@delete')->name('users.delete');
        Route::get('/{user_id}/disable', 'AdminUsersController@disable')->name('users.disable');
        Route::put('/{user_id}/block', 'AdminUsersController@block')->name('users.block');
        Route::put('/{user_id}/password', 'AdminUsersController@password')->name('users.password');
            
        //Roles routes//
        Route::group(['prefix' => 'users', 'as' => 'users.'], function ()  {
            Route::resource('/roles', 'RolesController')->except('show');
        });
        Route::get('/users/roles/{role_id}/delete', 'RolesController@delete')->name('users.roles.delete');
        Route::get('/users/roles/{role_id}/duplicate', 'RolesController@duplicate')->name('users.roles.duplicate');
    //End of Users routes
    


    ////////////////
    //Posts routes//
    ////////////////
        Route::resource('/posts', 'AdminPostsController')->except('show');
        Route::get('/posts/{post_id}/delete', 'AdminPostsController@delete')->name('posts.delete');
        
        //Categories routes//
        Route::group(['prefix' => 'posts', 'as' => 'posts.'], function ()  {
            Route::resource('/categories', 'AdminPostCategoriesController');
            Route::get('/categories/{category_id}/delete', 'AdminPostCategoriesController@delete')->name('categories.delete');
        });
    //End of Posts routes



    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function ()  {
        
        ///////////////
        //Logs routes//
        ///////////////
        Route::get('/logs', 'LogsController@index')->name('logs.index');
        //End of Logs routes

    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
