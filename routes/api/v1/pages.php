<?php
// OPEN ROUTES
Route::get('/v1/pages', 'api\PagesController@index');
Route::get('/v1/page/{id}', 'api\PagesController@show');

// AUTH ROUTES
Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('/v1/page', 'api\PagesController@store')->name('api.pages.store.single');
    Route::post('/v1/pages', 'api\PagesController@store')->name('api.pages.store.many');

    Route::delete('/v1/page/{id}', 'api\PagesController@destroy')->name('api.pages.delete.single');
    Route::delete('/v1/pages', 'api\PagesController@destroy')->name('api.pages.delete.many');

    Route::patch('/v1/page/{id}', 'api\PagesController@update')->name('api.pages.update.single');
    Route::patch('/v1/pages', 'api\PagesController@update')->name('api.pages.update.many');
});
