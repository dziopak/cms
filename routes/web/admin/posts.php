<?php
    Route::resource('/posts', 'admin\PostsController')->except('show');
    Route::get('/posts/{post_id}/delete', 'admin\PostsController@delete')->name('posts.delete');
    
    //Categories routes//
    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function ()  {
        Route::resource('/categories', 'admin\PostCategoriesController');
        Route::get('/categories/{category_id}/delete', 'admin\PostCategoriesController@delete')->name('categories.delete');
    });
?>