<?php

Route::get('/v1/portfolio/items', "PortfolioApiController@index");
Route::get('/v1/portfolio/item/{id}', "PortfolioApiController@show");
