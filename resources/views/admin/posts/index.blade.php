@extends('layouts.admin.containers.full-width')

@php
    $table_headers = [' ' => 'thumbnail', 'Title' => 'name', 'Visible' => 'is_active', 'Author' => 'author', 'Created at' => 'created_at'];
    $table_data_types = ['thumbnail' => 'image', 'author' => 'name', 'is_active' => 'boolean'];
    $table_actions = [
        'Edit' => [
            'url' => 'admin.posts.edit',
            'class' => 'success',
            'access' => 'POST_EDIT'
        ],
        'Delete' => [
            'url' => 'admin.posts.delete',
            'class' => 'danger',
            'access' => 'POST_DELETE'
        ]
    ];
    $mass_edit = [
        "delete" => "Delete selected",
        "hide" => "Disable / Hide",
        "show" => "Enable / Show",
    ];
    $sort_by = [
        'name' => 'Title',
        'user_id' => 'Author',
        'created_at' => 'Creation date'
    ];
@endphp

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.posts.index')}}">Posts</a></li>
        <li>List all</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Manage posts'])
        @include('admin.partials.searchfilterbar')
        {{ Form::open(['method' => 'POST', 'route' => 'admin.posts.mass', 'class' => 'w-100']) }}
            @include('admin.partials.table', ['fields' => $posts])
            @include('admin.partials.massedit')
        {{ Form::close() }}

        @if (Auth::user()->hasAccess('POST_CREATE'))
            <a href="{{ route('admin.posts.create') }}" class="btn btn-success">Create new</a>
        @endif

        <div class="float-right">{{ $posts->render() }}</div>
    @endwrapper
@endsection