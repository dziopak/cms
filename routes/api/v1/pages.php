<?php
    // OPEN ROUTES
    Route::get('/v1/pages', 'api\PagesController@index');
    Route::get('/v1/page/{id}', 'api\PagesController@show');

    // AUTH ROUTES
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('/v1/page', 'api\PagesController@store');
        Route::delete('/v1/page/{id}', 'api\PagesController@destroy');
        Route::patch('/v1/page/{id}', 'api\PagesController@update');
    });
