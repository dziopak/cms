@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.users.index')}}">Users</a></li>
        <li><a href="{{route('admin.users.roles.index')}}">Roles</a></li>
        <li>Delete</li>
    </ul>
@endsection

@section('content')
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title">
                    <strong>Role's info</strong>
                </div>
                   
                <div style="display: inline-block;">
                    <strong>{{$role->name}} role</strong><br/>
                    Created: {{$role->created_at}}<br/>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <strong>Remove role</strong>
                </div>

                <p class="alert alert-danger">Are you sure you want to permamently delete this role from system's database? This action is irreversible, and will change all {{$role->name}} accounts to regular user role.</p>
                
                {!! Form::open(['method' => 'DELETE', 'action' => ['RolesController@destroy', $role->id]]) !!}
                
                <div class="form-group">
                    <a href="{{route('admin.users.roles.index')}}" role="button" class="btn btn-success">Go back</a>
                    {!! Form::submit('Delete permamently', ['class' => 'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title">
                    <strong>{{ $role->name}} accounts:</strong>
                </div>
            </div>
        </div>
    </div>
@endsection