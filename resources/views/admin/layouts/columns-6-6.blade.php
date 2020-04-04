@extends('admin.layouts.layout')

@section('content')
    <div class="col-12">
        @yield('before')
        <div class="row">
            <div class="col-lg-6">
                @yield('content-left')
                @yield('module-content')
            </div>

            <div class="col-lg-6">
                @yield('content-right')
            </div>
        </div>

        <div class="row">
            @yield('content-bottom')
        </div>
        @yield('after')
    </div>
@endsection
