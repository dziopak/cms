<?php

Route::resource('/menus', 'Admin\Blocks\MenusController')->except('show');
Route::post('/menus/{menu_id}/detach/{item_id}', 'Admin\Blocks\MenusController@detach')->name('menus.detach');
Route::post('/menus/{id}/attach', 'Admin\Blocks\MenusController@attach')->name('menus.attach');
Route::post('/menus/{id}/order', 'Admin\Blocks\MenusController@order')->name('menus.order');
Route::post('/menus/search-items/', 'Admin\Blocks\MenusController@search')->name('menus.search.items');
Route::post('/menus/find-item/', 'Admin\Blocks\MenusController@find')->name('menus.find');
Route::patch('/menus/{menu}/update', 'Admin\Blocks\MenusController@update')->name('menus.update');
Route::post('/menus/mass/', 'Admin\Blocks\MenusController@mass')->name('menus.mass');
