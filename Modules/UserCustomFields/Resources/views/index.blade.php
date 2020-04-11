@extends('admin.layouts.full-width')


@php
    $table_headers = ['Field name' => 'name', 'Field slug' => 'slug', 'Field type' => 'type', 'Required' => 'required'];
    $table_data_types = ['required' => 'boolean'];
    $table_actions = [
        'Edit' => [
            'url' => 'admin.modules.usercustomfields.edit',
            'class' => 'success',
            'access' => 'MODULE_EDIT'
        ]
    ];
@endphp


@section('breadcrumbs')
    <ul>
        <li>Admin</li>
        <li>Modules</li>
        <li>User Custom Fields</li>
        <li>List all</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.wrapper', ['title' => 'Manage custom fields'])
        @include('admin.partials.table')
    @endwrapper
    <a href="{{ route('admin.modules.usercustomfields.create') }}" class="btn btn-success">Create new</a>
@endsection
