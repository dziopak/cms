<?php

Route::resource('/categories', 'Admin\Modules\CategoriesController')->except('show');
Route::post('/categories/mass', 'Admin\Modules\CategoriesController@mass')->name('categories.mass');
