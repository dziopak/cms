@extends('layouts.admin.containers.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.posts.index')}}">Posts</a></li>
        <li><a href="{{route('admin.posts.categories.index')}}">Categories</a></li>
        <li>List all</li>
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