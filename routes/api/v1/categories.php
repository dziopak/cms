<?php
// OPEN ROUTES
Route::get('/v1/categories', 'api\CategoriesController@index');
Route::get('/v1/category/{id}', 'api\CategoriesController@show');

// AUTH ROUTES
Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('/v1/category', 'api\CategoriesController@store')->name('api.categories.store.single');
    Route::post('/v1/categories', 'api\CategoriesController@store')->name('api.categories.store.many');

    Route::delete('/v1/category/{id}', 'api\CategoriesController@destroy')->name('api.categories.delete.single');
    Route::delete('/v1/categories', 'api\CategoriesController@destroy')->name('api.categories.delete.many');

    Route::patch('/v1/category/{id}', 'api\CategoriesController@update')->name('api.categories.update.single');
    Route::patch('/v1/categories', 'api\CategoriesController@update')->name('api.categories.update.many');
});
