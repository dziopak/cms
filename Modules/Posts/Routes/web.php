<?php
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function ()  {
    
    ////////////////
    //Posts routes//
    ////////////////
    Route::resource('/posts', 'AdminPostsController');
    
});
