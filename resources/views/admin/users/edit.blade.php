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
        @include('partials.form-fields', ['fields' => $form['left']])
        
        
        <div class="form-group">
            <input type="hidden" value="{{$user->id}}" name="user_id" />
            {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
        </div>
        
        {!! Form::close() !!}
    @endwrapper
@endsection

@section('content-right')    
    @wrapper('admin.partials.widget', ['title' => 'User info'])
        @if ($user->photo)
            <img class="rounded-circle mr-4 float-left" width="100" src="{{ getPublicPath() }}/images/{{$user->photo->path}}">
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
        
        @include('partials.form-fields', ['fields' => $form['right']])

        {!! Form::submit('Set password', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    @endwrapper
@endsection