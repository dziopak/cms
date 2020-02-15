@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.users.index')}}">Users</a></li>
        <li><a href="{{route('admin.roles.index')}}">Roles</a></li>
        <li>List all</li>
    </ul>
@endsection


@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <strong>Manage users roles</strong>
                </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 20px;">
                                <input type="checkbox" name="action[all]">
                            </th>
                            <th>Role name</th>
                            <th style="width: 260px;">Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td><input type="checkbox" name="action[{{$role->id}}]"></td>
                                <td>{{$role->name}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('admin.roles.edit', $role->id) }}">Edit</a>
                                    @if (Auth::user()->hasAccess('ROLE_CREATE'))
                                        <a class="btn btn-primary" href="{{ route('admin.roles.duplicate', $role->id) }}">Duplicate</a>
                                    @endif

                                    @if ($role->id > 1)
                                        <a class="btn btn-danger" href="{{ route('admin.roles.delete', $role->id) }}">Delete</a></td>
                                        @else
                                        <a class="btn btn-danger disabled" href="#">LOCKED</a></td>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('admin.roles.create') }}" class="btn btn-success">Create new role</a>
            </div>
        </div>
    </div>
@endsection