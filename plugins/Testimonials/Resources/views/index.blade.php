@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.plugins.index')}}">Modules</a></li>
        <li><a href="{{route('admin.plugins.testimonials.index')}}">Testimonials</a></li>
        <li>List all</li>
    </ul>
@endsection


@section('module-content')
    <x-wrapper title="Manage testimonials">
        <x-table :table="$table" :fields="$testimonials" />

        @if (Auth::user()->hasAccess('MODULE_USE'))
            <a href="{{ route('admin.plugins.testimonials.create') }}" class="btn btn-success">Create new</a>
        @endif
    </x-wrapper>
@endsection
