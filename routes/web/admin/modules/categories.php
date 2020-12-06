<?php

Route::resource('/categories', 'Admin\Modules\Categories\CategoriesController')->except('show');
Route::post('/categories/mass', 'Admin\Modules\Categories\CategoriesController@mass')->name('categories.mass');
