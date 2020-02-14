@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.users.index')}}">Users</a></li>
        <li>Edit</li>
    </ul>
@endsection

@section('content')
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <strong>Basic data</strong>
                </div>

                {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AdminUsersController@update', $user->id], 'files' => 'true']) !!}
                
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
                        {!! Form::label('role_id', 'User\'s role: ') !!}
                        {!! Form::select('role_id', $roles, null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col">
                        {!! Form::label('email', 'Email address: ') !!}
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
                    {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
                </div>
                <input type="hidden" value="{{$user->id}}" name="user_id" />
                {!! Form::close() !!}
            </div>
        </div>
    </div>
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-title">
                            <strong>User's info</strong>
                        </div>
                        
                        @if ($user->avatar)
                            <img class="rounded-circle mr-4 float-left" width="100" src="/images/avatars/{{$user->photo->path}}">
                        @endif

                        <div style="display: inline-block;">
                            <strong>{{'@'.$user->name}}</strong><br/>
                           
                            @if ($user->first_name && $user->last_name)
                                <span>{{$user->first_name.' '.$user->last_name}}</span><br/>
                            @endif
                           
                            Created: {{$user->created_at}}<br/>
                            <small>{{$user->role->name}}</small>
                        </div>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-title">
                            <strong>Change password:</strong>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-title">
                            <strong>Recent Actions:</strong>
                        </div>

                        @include('admin.partials.logs')
                    </div>
                </div>
            </div>
@endsection