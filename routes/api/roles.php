<?php
    // OPEN ROUTES
    Route::get('/roles', 'api\RolesController@index');
    Route::get('/role/{id}', 'api\RolesController@show');

    // AUTH ROUTES
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('/role', 'api\RolesController@store');
        Route::delete('/role/{id}', 'api\RolesController@destroy');
        Route::patch('/role/{id}', 'api\RolesController@update');
    });
?>