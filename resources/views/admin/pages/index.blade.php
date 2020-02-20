@extends('layouts.admin.containers.full-width')

<?php
    $table_headers = [' ' => 'thumbnail', 'Title' => 'name', 'Author' => 'author', 'Created at' => 'created_at'];
    $table_data_types = ['thumbnail' => 'image', 'author' => 'name'];
    $table_actions = [
        'Edit' => [
            'url' => 'admin.pages.edit',
            'class' => 'success',
            'access' => 'PAGE_EDIT'
        ],
        'Delete' => [
            'url' => 'admin.pages.delete',
            'class' => 'danger',
            'access' => 'PAGE_DELETE'
        ]
    ];
?>

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.pages.index')}}">Pages</a></li>
        <li>List all</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Manage pages'])    
        @include('admin.partials.table', ['fields' => $pages])

        @if (Auth::user()->hasAccess('POST_CREATE'))
            <a href="{{ route('admin.pages.create') }}" class="btn btn-success">Create new</a>
        @endif

        <div class="float-right">{{ $pages->render() }}</div>
    @endwrapper
@endsection