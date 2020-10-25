<?php
    // OPEN ROUTES
    Route::get('/v1/roles', 'api\RolesController@index');
    Route::get('/v1/role/{id}', 'api\RolesController@show');

    // AUTH ROUTES
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('/v1/role', 'api\RolesController@store');
        Route::delete('/v1/role/{id}', 'api\RolesController@destroy');
        Route::patch('/v1/role/{id}', 'api\RolesController@update');
    });
