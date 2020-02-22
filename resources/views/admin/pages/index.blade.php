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
    $mass_edit = [
        "delete" => "Delete selected",
        "hide" => "Disable / Hide",
        "show" => "Enable / Show",
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
        {{ Form::open(['method' => 'POST', 'route' => 'admin.pages.mass', 'class' => 'w-100']) }}
            @include('admin.partials.table', ['fields' => $pages])
            @include('admin.partials.massedit')
        {{ Form::close() }}
        
        @if (Auth::user()->hasAccess('PAGE_CREATE'))
            <a href="{{ route('admin.pages.create') }}" class="btn btn-success">Create new</a>
        @endif

        <div class="float-right">{{ $pages->render() }}</div>
    @endwrapper
@endsection