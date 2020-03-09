<?php
    // OPEN ROUTES
    Route::get('/menus', 'api\MenusController@index');
    Route::get('/menu/{id}/', 'api\MenusController@show');
    
    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('/menus', 'api\MenusController@create');
        Route::delete('/menu/{id}/', 'api\MenusController@destroy');
        Route::patch('/menu/{id}/', 'api\MenusController@update');
    });
?>