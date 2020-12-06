<?php

Route::get('/', 'Admin\Modules\Dashboards\DashboardsController@index')->name('dashboard.index');
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::post('/dashboard', 'Admin\Modules\Dashboards\DashboardController@update')->name('update');
    Route::get('/dashboard/widget', 'Admin\Modules\Dashboards\DashboardGetWidgetController')->name('getwidget');
});
