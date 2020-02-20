@extends('layouts.admin.containers.columns-6-6')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.users.index')}}">Users</a></li>
        <li><a href="{{route('admin.users.roles.index')}}">Roles</a></li>
        <li>Delete</li>
    </ul>
@endsection

@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'Basic role data'])
        <div style="display: inline-block;">
            <strong>{{$role->name}} role</strong><br/>
            Created: {{$role->created_at}}<br/>
        </div>
    @endwrapper

    @wrapper('admin.partials.widget', ['title' => 'Remove role'])
        <p class="alert alert-danger">Are you sure you want to permamently delete this role from system's database? This action is irreversible, and will change all {{$role->name}} accounts to regular user role.</p>
        
        {!! Form::open(['method' => 'DELETE', 'action' => ['admin\RolesController@destroy', $role->id]]) !!}
        
        <div class="form-group">
            <a href="{{route('admin.users.roles.index')}}" role="button" class="btn btn-success">Go back</a>
            {!! Form::submit('Delete permamently', ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    @endwrapper
@endsection

@section('content-right')
    @wrapper('admin.partials.widget', ['title' => 'Accounts with this role'])
    @endwrapper
@endsection