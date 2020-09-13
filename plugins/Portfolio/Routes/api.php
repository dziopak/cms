<?php

Route::get('/portfolio/items', "PortfolioApiController@index");
Route::get('/portfolio/item/{id}', "PortfolioApiController@show");
