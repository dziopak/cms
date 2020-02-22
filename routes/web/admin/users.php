<?php
    Route::resource('/users', 'admin\UsersController')->except('show');
    Route::get('/{user_id}/delete', 'admin\UsersController@delete')->name('users.delete');
    Route::get('/{user_id}/disable', 'admin\UsersController@disable')->name('users.disable');
    Route::put('/{user_id}/block', 'admin\UsersController@block')->name('users.block');
    Route::put('/{user_id}/password', 'admin\UsersController@password')->name('users.password');
    Route::post('/users/mass', 'admin\UsersController@mass')->name('users.mass');
        
    //Roles routes//
    Route::group(['prefix' => 'users', 'as' => 'users.'], function ()  {
        Route::resource('/roles', 'admin\RolesController')->except('show');
    });
    Route::get('/users/roles/{role_id}/delete', 'admin\RolesController@delete')->name('users.roles.delete');
    Route::get('/users/roles/{role_id}/duplicate', 'admin\RolesController@duplicate')->name('users.roles.duplicate');
?>