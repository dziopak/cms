@extends('admin.layouts.layout')

@section('content')
    <div class="col-12">
        @yield('before')
        @yield('module-content')
        @yield('after')
    </div>
@endsection
