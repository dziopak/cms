<?php

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::resource('/roles', 'Admin\Modules\Roles\RolesController')->except('show');
    Route::get('/roles/{role_id}/duplicate', 'Admin\Modules\Roles\RoleDuplicateController')->name('roles.duplicate');
});
