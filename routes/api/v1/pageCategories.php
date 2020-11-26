<?php
// OPEN ROUTES

Route::get('/v1/pages/categories/', 'api\PageCategoriesController@index');
Route::get('/v1/pages/category/{id}/', 'api\PageCategoriesController@show');

Route::get('/v1/category/{category}/pages/', 'api\PageCategoriesController@pages');
Route::get('/v1/pages/category/{category}/entries/', 'api\PageCategoriesController@pages');

    // Route::group(['middleware' => ['jwt.verify']], function() {
    //     Route::post('/v1/pages/category/', 'api\PageCategoriesController@store');
    //     Route::delete('/v1/pages/category/{id}/', 'api\PageCategoriesController@destroy');
    //     Route::patch('/v1/pages/category/{id}/', 'api\PageCategoriesController@update');
    // });
