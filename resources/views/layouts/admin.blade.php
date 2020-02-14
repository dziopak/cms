<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="admin-page">
    <div id="main-container" class="container-fluid">
        <div class="row">
            <div class="col-3 col-sm-3 col-md-2 col-lg-1 sidebar">
                <ul class="sidebar-list">
                    <li class="sidebar-list-item">
                        <div class="icon"></div>
                        Dashboard
                    </li>
                    <li class="sidebar-list-item">
                        <div class="icon"></div>
                        Pages
                        <ul class="sidebar-sub-list">
                            <li class="sidebar-list-item">List all</li>
                            <li class="sidebar-list-item">Create new</li>
                        </ul>
                    </li>
                    <li class="sidebar-list-item">
                        <div class="icon"></div>
                        Posts
                        <ul class="sidebar-sub-list">
                            <li class="sidebar-list-item">List all</li>
                            <li class="sidebar-list-item">Create new</li>
                        </ul>
                    </li>
                    <li class="sidebar-list-item">
                        <div class="icon"></div>
                        Users
                        <ul class="sidebar-sub-list">
                            <li class="sidebar-list-item"><a href="{{route('admin.users.index')}}">List all</a></li>
                            <li class="sidebar-list-item"><a href="{{route('admin.users.create')}}">Create new</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list-item">
                        <div class="icon"></div>
                        Newsletter
                        <ul class="sidebar-sub-list">
                            <li class="sidebar-list-item">Message templates</li>
                            <li class="sidebar-list-item">Create new template</li>
                            <li class="sidebar-list-item">Send message</li>
                        </ul>
                    </li>
                    <li class="sidebar-list-item">
                        <div class="icon"></div>
                        Settings
                        <ul class="sidebar-sub-list">
                            <li class="sidebar-list-item">General settings</li>
                            <li class="sidebar-list-item">SEO settings</li>
                            <li class="sidebar-list-item">Mail settings</li>
                        </ul>
                    </li>
                </ul>
                <div id="version">DMS v1.0.0</div>
            </div>

            <div id="admin-main" class="col-9 col-sm-9 col-md-10 col-lg-11">
                <div class="row">
                    <div id="top-nav">
                        <div class="col-9">
                            <div class="breadcrumbs">
                                @yield('breadcrumbs')
                            </div>
                        </div>

                        <div class="col-3">
                            
                        </div>
                    </div>
                </div>

                <div class="row py-3 pr-3">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

@yield('footer')
</body>

</html>
