@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.modules.index')}}">Modules</a></li>
        <li><a href="{{route('admin.modules.testimonials.index')}}">Testimonials</a></li>
        <li>List all</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.wrapper', ['title' => 'Manage testimonials'])
        @include('admin.partials.table', ['fields' => $testimonials])

        @if (Auth::user()->hasAccess('MODULE_USE'))
            <a href="{{ route('admin.modules.testimonials.create') }}" class="btn btn-success">Create new</a>
        @endif
    @endwrapper
@endsection
