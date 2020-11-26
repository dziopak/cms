<?php
Route::resource('/pages', 'Admin\Modules\PagesController')->except('show');
Route::get('/pages/{page}/delete', 'Admin\Modules\PagesController@delete')->name('pages.delete');
Route::post('/pages/mass', 'Admin\Modules\PagesController@mass')->name('pages.mass');
Route::post('/pages/{page}/thumbnail', 'Admin\Modules\PagesController@thumbnail')->name('pages.thumbnail');

// Categories routes//
Route::group(['prefix' => 'pages', 'as' => 'pages.'], function () {
    Route::resource('/layouts', 'Admin\Modules\LayoutsController');
    Route::get('/layouts/{layout}/delete', 'Admin\Modules\LayoutsController@delete')->name('layouts.delete');
    Route::post('/layouts/mass', 'Admin\Modules\LayoutsController@mass')->name('layouts.mass');
});

Route::get('/layouts/widget', 'Admin\Modules\LayoutsController@getBlock')->name('layouts.getwidget');
