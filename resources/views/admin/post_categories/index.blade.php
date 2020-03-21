@extends('layouts.admin.containers.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.posts.index')}}">{{ __('admin/routes.posts') }}</a></li>
        <li><a href="{{route('admin.posts.categories.index')}}">{{ __('admin/routes.categories') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Manage categories'])  

        @include('admin.partials.searchfilterbar')
        {{ Form::open(['method' => 'POST', 'route' => 'admin.posts.categories.mass', 'class' => 'w-100']) }}
            @include('admin.partials.table', ['fields' => $categories])
            @include('admin.partials.massedit')
        {{ Form::close() }}

        @if (Auth::user()->hasAccess('CATEGORY_CREATE'))
            <a href="{{ route('admin.posts.categories.create') }}" class="btn btn-success">Create new</a>
        @endif

        <div class="float-right">{{ $categories->render() }}</div>
    @endwrapper
@endsection