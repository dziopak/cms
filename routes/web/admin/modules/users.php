<?php
Route::resource('/users', 'Admin\Modules\UsersController')->except('show');
Route::get('/{user_id}/delete', 'Admin\Modules\UsersController@delete')->name('users.delete');
Route::get('/{user_id}/disable', 'Admin\Modules\UsersController@disable')->name('users.disable');
Route::put('/{user_id}/block', 'Admin\Modules\UsersController@block')->name('users.block');
Route::put('/{user_id}/password', 'Admin\Modules\UsersController@password')->name('users.password');
Route::post('/{user_id}/thumbnail', 'Admin\Modules\UsersController@thumbnail')->name('users.thumbnail');
Route::post('/users/mass', 'Admin\Modules\UsersController@mass')->name('users.mass');

//Roles routes//
Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::resource('/roles', 'Admin\Modules\RolesController')->except('show');
});
Route::get('/users/roles/{role_id}/delete', 'Admin\Modules\RolesController@delete')->name('users.roles.delete');
Route::get('/users/roles/{role_id}/duplicate', 'Admin\Modules\RolesController@duplicate')->name('users.roles.duplicate');
