@extends('layouts.admin.containers.full-width')

@php
    $table_headers = [' ' => 'photo', 'Email' => 'email', 'Active' => 'is_active', 'Role' => 'role', 'Created' => 'created_at'];
    $table_data_types = ['photo' => 'image', 'is_active' => 'boolean', 'created_at' => 'date', 'role' => 'name'];
    $table_actions = [
        'Edit' => [
            'url' => 'admin.users.edit',
            'class' => 'success',
            'access' => 'USER_EDIT'
        ],
        'Status' => [
            'url' => 'admin.users.disable',
            'class' => 'primary',
            'access' => 'USER_EDIT'
        ],
        'Delete' => [
            'url' => 'admin.users.delete',
            'class' => 'danger',
            'access' => 'USER_DELETE'
        ]
    ];
    $mass_edit = [
        "delete" => "Delete selected",
        "hide" => "Disable / Hide",
        "show" => "Enable / Show",
        "role" => "Set role",
    ];
    $mass_edit_extend = 'users';
    $table_headers = Hook::get('UsersIndexTableHeaders',[$table_headers],function($table_headers){
        return $table_headers;
    });
    $sort_by = [
        'name' => 'Username',
        'email' => 'Email',
        'first_name' => 'First name',
        'last_name' => 'Last name',
    ];
@endphp

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.users.index')}}">Users</a></li>
        <li>List all</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Manage users'])

        @include('admin.partials.searchfilterbar')
        {{ Form::open(['method' => 'POST', 'route' => 'admin.users.mass', 'class' => 'w-100']) }}
            @include('admin.partials.table', ['fields' => $users])
            @include('admin.partials.massedit')
        {{ Form::close() }}

        @if (Auth::user()->hasAccess('USER_CREATE'))
            <a href="{{ route('admin.users.create') }}" class="btn btn-success">Create new</a>
        @endif

        <div class="float-right">{{ $users->render() }}</div>
    @endwrapper
@endsection