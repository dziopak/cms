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

            <!-- Left sidebar -->
            @include('admin.partials.sidebar')
            
            <div id="admin-main" class="col-9 col-sm-9 col-md-10 col-lg-11">
                
                <!-- Top navigation bar -->
                @include('admin.partials.top-nav')

                <div class="row py-3 pr-3">
                    <!-- Action alert -->
                    @if (Session::has('crud')) 
                    <p class="alert alert-success mx-3 w-100">{{ session('crud') }}</p>
                    @endif
                    
                    <!-- Module -->
                    @yield('content')

                </div>
            </div>
        </div>
    </div>

    @yield('footer')
</body>

</html>
