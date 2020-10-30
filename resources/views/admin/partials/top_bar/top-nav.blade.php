<div class="row">
    <div id="top-nav">
        <div class="flex-spread">
            <div id="top-breadcrumbs" class="breadcrumbs text-left ml-3">
                @yield('breadcrumbs')
            </div>
            @include('admin.partials.top_bar.user-bar')
            @include('admin.partials.top_bar.nav-toolbar')
        </div>
    </div>
</div>
