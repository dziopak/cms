<?php


Route::group(['prefix' => 'blocks', 'as' => 'blocks.'], function () {

    //SLIDERS ROUTES
    require base_path('routes/web/admin/blocks/sliders.php');

    //BLOCKS ROUTES
    require base_path('routes/web/admin/blocks/menus.php');
});
