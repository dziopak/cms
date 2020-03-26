<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.admin.partials.head')
</head>

<body id="admin-page">
    <div id="main-container" class="container-fluid">
        <div class="row">


            {{-- Sidebar --}}
            @include('admin.partials.sidebar')
            {{-- End of Sidebar --}}


            {{-- Main area --}}
            <div id="admin-main" class="col">
                
                <!-- Top navigation bar -->
                @include('admin.partials.top-nav')

                <div id="module" class="row py-3 pr-3">
                    <!-- Action alert -->
                    @include('layouts.admin.partials.alert')
                    
                    <!-- Module -->
                    @yield('content')
                </div>
            </div>
            {{-- End of Main area --}}


        </div>
    </div>

    @yield('footer')
    @stack('scripts-bottom')
</body>

</html>
