<?php
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
?>