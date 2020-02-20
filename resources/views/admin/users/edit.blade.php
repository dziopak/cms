@extends('layouts.admin.containers.columns-6-6')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.users.index')}}">Users</a></li>
        <li>Edit</li>
    </ul>
@endsection

@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'Basic user data'])
        {!! Form::model($user, ['method' => 'PATCH', 'action' => ['admin\UsersController@update', $user->id], 'files' => 'true']) !!}
        @include('admin.partials.validation')
        
        <div class="form-group row">
            <div class="col">
                {!! Form::label('first_name', 'First name: ') !!}
                {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="col">
                {!! Form::label('last_name', 'Last name: ') !!}
                {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="col">
                {!! Form::label('role_id', 'User\'s role*: ', ['class' => 'required']) !!}
                {!! Form::select('role_id', $roles, null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="col">
                {!! Form::label('email', 'Email address*: ', ['class' => 'required']) !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="col">
                {!! Form::label('avatar', 'Avatar: ') !!}
                {!! Form::file('avatar', ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
        </div>

        <input type="hidden" value="{{$user->id}}" name="user_id" />
        {!! Form::close() !!}
    @endwrapper
@endsection

@section('content-right')    
    @wrapper('admin.partials.widget', ['title' => 'User info'])
        @if ($user->avatar)
            <img class="rounded-circle mr-4 float-left" width="100" src="/images/{{$user->photo->path}}">
        @endif

        <div style="display: inline-block;">
            <strong>{{'@'.$user->name}}</strong><br/>
            
            @if ($user->first_name && $user->last_name)
                <span>{{$user->first_name.' '.$user->last_name}}</span><br/>
            @endif
            
            Created: {{$user->created_at}}<br/>
            <small>{{$user->role->name}}</small>
        </div>
    @endwrapper

    @wrapper('admin.partials.widget', ['title' => 'Recent actions'])
        @include('admin.partials.logs')
    @endwrapper

    @wrapper('admin.partials.widget', ['title' => 'Change password'])
        {!! Form::open(['method' => 'PUT', 'action' => ['admin\UsersController@password', $user->id]]) !!}
        <div class="form-group row">
            <div class="col-sm-6">
                {!! Form::label('password', 'Password: ', ['class' => 'required']) !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>

            <div class="col-sm-6">
                {!! Form::label('repeat_password', 'Repeat password: ', ['class' => 'required']) !!}
                {!! Form::password('repeat_password', ['class' => 'form-control']) !!}
            </div>
        </div>
        {!! Form::submit('Set password', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    @endwrapper
@endsection