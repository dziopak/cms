<?php

Route::get('/', 'Admin\Modules\DashboardController@index')->name('dashboard.index');
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::post('/dashboard', 'Admin\Modules\DashboardController@update')->name('update');
    Route::get('/dashboard/widget', 'Admin\Modules\DashboardController@getWidget')->name('getwidget');
});
