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
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td style="width: 20px;">
                        <input type="checkbox" name="action[all]">
                    </td>
                    <th>Role name</th>
                    <th style="width: 20%;">Actions</th>
                </tr>
            </thead>

            @foreach($roles as $role)
                <tr>
                    <td><input type="checkbox" name="action[{{$role->id}}]"></td>
                    <td>{{$role->name}}</td>
                    <td><a class="btn btn-success" href="{{ route('admin.roles.edit', $role->id) }}">Edit</a> <a class="btn btn-primary" href="#">Duplicate</a> <a class="btn btn-danger" href="">Delete</a></td>
                <tr>
            @endforeach
        </table>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-success">Create new role</a>
    </div>
@endsection