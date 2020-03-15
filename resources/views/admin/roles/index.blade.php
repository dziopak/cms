@extends('layouts.admin.containers.full-width')

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