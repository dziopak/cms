@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.users.index')}}">Users</a></li>
        <li>Create</li>
    </ul>
@endsection

@section('content')
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <strong>Basic data</strong>
                </div>

                {!! Form::open(['method' => 'POST', 'action' => 'admin\UsersController@store', 'files' => 'true']) !!}
        
                @include('admin.partials.validation')

                <div class="form-group row">
                    <div class="col-sm-6">
                        {!! Form::label('name', 'Username: ', ['class' => 'required']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="col-sm-6">
                        {!! Form::label('role_id', 'User\'s role: ', ['class' => 'required']) !!}
                        {!! Form::select('role_id', $roles, null, ['class' => 'form-control']) !!}
                    </div>
                </div>

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
                
                <div class="form-group row">
                    <div class="col">
                        {!! Form::label('email', 'Email address: ', ['class' => 'required']) !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

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
                        {!! Form::label('avatar', 'Avatar: ') !!}
                        {!! Form::file('avatar', ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
                </div>

                {!! Form::close() !!}
            </div>
          </div>
    </div>
@endsection