@extends('layouts.admin.containers.full-width')

<?php
    $table_headers = ['Category name' => 'name'];
    $table_actions = [
        'Edit' => [
            'url' => 'admin.pages.categories.edit',
            'class' => 'success',
            'access' => 'CATEGORY_EDIT'
        ],
        'Delete' => [
            'url' => 'admin.pages.categories.delete',
            'class' => 'danger',
            'access' => 'CATEGORY_DELETE'
        ]
    ];
    $mass_edit = [
        'delete' => 'Delete selected'
    ];
?>

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.pages.index')}}">Pages</a></li>
        <li><a href="{{route('admin.pages.categories.index')}}">Categories</a></li>
        <li>List all</li>
    </ul>
@endsection

@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Manage categories'])
        {{ Form::open(['method' => 'POST', 'route' => 'admin.pages.categories.mass', 'class' => 'w-100']) }}
            @include('admin.partials.table', ['fields' => $categories])
            @include('admin.partials.massedit')
        {{ Form::close() }}

        @if (Auth::user()->hasAccess('CATEGORY_CREATE'))
            <a href="{{ route('admin.pages.categories.create') }}" class="btn btn-success">Create new</a>
        @endif
        <div class="float-right">{{ $categories->render() }}</div>
    @endwrapper    
@endsection