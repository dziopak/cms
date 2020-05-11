<?php

Route::resource('/menus', 'Admin\Blocks\MenusController')->except('show');
Route::post('/menus/{menu_id}/detach/{item_id}', 'Admin\Blocks\MenusController@detach')->name('menus.detach');
Route::post('/menus/{id}/attach', 'Admin\Blocks\MenusController@attach')->name('menus.attach');
Route::post('/menus/{id}/order', 'Admin\Blocks\MenusController@order')->name('menus.order');
Route::post('/menus/search-items/', 'Admin\Blocks\MenusController@search')->name('menus.search.items');
Route::post('/menus/mass/', 'Admin\Blocks\MenusController@mass')->name('menus.mass');
