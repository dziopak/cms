<?php
    // OPEN ROUTES
    Route::get('/v1/menus', 'api\MenusController@index');
    Route::get('/v1/menu/{id}/', 'api\MenusController@show');

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('/v1/menus', 'api\MenusController@store');
        Route::delete('/v1/menu/{id}/', 'api\MenusController@destroy');
        Route::patch('/v1/menu/{id}/', 'api\MenusController@update');
    });
