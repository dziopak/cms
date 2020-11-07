<?php


Route::group(['prefix' => 'blocks', 'as' => 'blocks.'], function () {

    Route::get('/', 'Admin\Modules\BlocksController@index')->name('index');

    //SLIDERS ROUTES
    require base_path('routes/web/admin/blocks/sliders.php');

    //MENUS ROUTES
    require base_path('routes/web/admin/blocks/menus.php');

    //MENUS ROUTES
    require base_path('routes/web/admin/blocks/carousels.php');
});


Route::get('/menus', function () {
    return view('admin.menus.index');
})->name('widgets.menus.index');
