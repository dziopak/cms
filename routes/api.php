<?php

use Illuminate\Http\Request;

//POSTS ROUTES
require base_path('routes/api/v1/posts.php');
require base_path('routes/api/v1/postCategories.php');

//PAGES ROUTES
require base_path('routes/api/v1/pages.php');
require base_path('routes/api/v1/pageCategories.php');

//MENUS ROUTES
require base_path('routes/api/v1/menus.php');

//USERS RESOURCE
require base_path('routes/api/v1/auth.php');
require base_path('routes/api/v1/roles.php');
require base_path('routes/api/v1/users.php');
