@extends('layouts.admin.containers.full-width')

<?php
    $table_headers = [' ' => 'thumbnail', 'Title' => 'name', 'Author' => 'author', 'Created at' => 'created_at'];
    $table_data_types = ['thumbnail' => 'image', 'author' => 'name'];
    $table_actions = [
        'Edit' => [
            'url' => 'admin.posts.edit',
            'class' => 'success',
            'access' => 'PAGE_EDIT'
        ],
        'Delete' => [
            'url' => 'admin.posts.delete',
            'class' => 'danger',
            'access' => 'PAGE_DELETE'
        ]
    ];
?>

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.posts.index')}}">Posts</a></li>
        <li>List all</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Manage posts'])
        @include('admin.partials.table', ['fields' => $posts])
        
        @if (Auth::user()->hasAccess('POST_CREATE'))
            <a href="{{ route('admin.posts.create') }}" class="btn btn-success">Create new</a>
        @endif

        <div class="float-right">{{ $posts->render() }}</div>
    @endwrapper
@endsection