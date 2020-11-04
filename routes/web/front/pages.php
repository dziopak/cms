
<?php

Route::get('/{id}', 'Front\PagesController@show')->name('pages.show');
Route::get('/category/{category}/pages', 'Front\PageCategoriesController@show')->name('pages.categories.show');
