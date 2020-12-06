<?php
Route::resource('/users', 'Admin\Modules\Users\UsersController')->except('show');
Route::get('/{user}/delete', 'Admin\Modules\Users\UsersController@delete')->name('users.delete');
Route::post('/users/mass', 'Admin\Modules\Users\UsersController@mass')->name('users.mass');

Route::put('/{user}/password', 'Admin\Modules\Users\UserPasswordController')->name('users.password');

Route::get('/{user}/disable', 'Admin\Modules\Users\UserStatusController@edit')->name('users.disable');
Route::put('/{user}/block', 'Admin\Modules\Users\UsersStatusController@update')->name('users.block');
