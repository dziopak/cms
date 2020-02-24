@extends('layouts.admin.containers.full-width')

@php
    $table_headers = ['Role name' => 'name'];
    $table_actions = [
        'Edit' => [
            'url' => 'admin.users.roles.edit',
            'class' => 'success',
            'access' => 'ROLE_EDIT'
        ],
        'Duplicate' => [
            'url' => 'admin.users.roles.duplicate',
            'class' => 'primary',
            'access' => 'ROLE_CREATE'
        ],
        'Delete' => [
            'url' => 'admin.users.roles.delete',
            'class' => 'danger',
            'disabled' => ['0', '1'],
            'access' => 'ROLE_DELETE'
        ],
    ];
    $sort_by = [
        'name' => 'Name'
    ];
@endphp

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.users.index')}}">Users</a></li>
        <li><a href="{{route('admin.users.roles.index')}}">Roles</a></li>
        <li>List all</li>
    </ul>
@endsection

@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Manage user roles'])
        
        @include('admin.partials.searchfilterbar')
        @include('admin.partials.table', ['fields' => $roles])

        @if (Auth::user()->hasAccess('ROLE_CREATE'))
            <a href="{{ route('admin.users.roles.create') }}" class="btn btn-success">Create new</a>
        @endif

        <div class="float-right">{{ $roles->render() }}</div>
    @endwrapper
@endsection