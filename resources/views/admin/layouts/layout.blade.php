<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.partials.head')
</head>

<body id="admin-page">
    <div id="main-container" class="container-fluid">
        <div class="row">


            {{-- Sidebar --}}
            @include('admin.partials.sidebar')
            {{-- End of Sidebar --}}


            {{-- Main area --}}
            <div id="admin-main" class="col w-100 overflow-hidden">

                <!-- Top navigation bar -->
                @include('admin.partials.top-nav')

                <div id="module" class="row py-3 pr-3">
                    <!-- Action alert -->
                    @include('admin.layouts.partials.alert')

                    <!-- Module -->
                    @yield('content')
                </div>
            </div>
            {{-- End of Main area --}}


        </div>
    </div>

    @yield('footer')
    @stack('scripts-bottom')

    <script>
        @hook('adminInlineScripts')
        </script>
    <script src="{{asset('js/admin/defer.js')}}" defer></script>
    @hook('adminScriptsDefer')
</body>

</html>
