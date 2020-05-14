@extends('admin.layouts.layout')

@section('content')
    <div class="col-12">
        @yield('before')
        <div class="row">
            <div class="col-lg-4">
                @yield('content-left')
                @yield('module-content')
            </div>
            <div class="col-lg-8">
                @yield('content-right')
            </div>
        </div>

        <div class="row">
            @yield('content-bottom')
            @stack('content-bottom')
        </div>
        @yield('after')
        @stack('after')
    </div>
@endsection
