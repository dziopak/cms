<?php
    // OPEN ROUTES
    Route::get('/pages', 'api\PagesController@index');
    Route::get('/page/{id}', 'api\PagesController@show');

    // AUTH ROUTES
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('/page', 'api\PagesController@store');
        Route::delete('/page/{id}', 'api\PagesController@destroy');
        Route::patch('/page/{id}', 'api\PagesController@update');
    });
?>