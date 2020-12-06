<?php
Route::group(['prefix' => 'pages', 'as' => 'pages.'], function () {
    Route::resource('/layouts', 'Admin\Modules\Layouts\LayoutsController');
    Route::get('/layouts/{layout}/delete', 'Admin\Modules\Layouts\LayoutsController@delete')->name('layouts.delete');
    Route::post('/layouts/mass', 'Admin\Modules\Layouts\LayoutsController@mass')->name('layouts.mass');
});

Route::get('/layouts/block', 'Admin\Modules\Layouts\LayoutGetBlockController')->name('layouts.getwidget');
