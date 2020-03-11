<?php

use Illuminate\Http\Request;

//POSTS ROUTES
require base_path('routes/api/posts.php');
require base_path('routes/api/postCategories.php');

//PAGES ROUTES
require base_path('routes/api/pages.php');

//MENUS ROUTES
require base_path('routes/api/menus.php');

//AUTHORIZATION ROUTES
require base_path('routes/api/auth.php');
