@extends('layouts.admin.containers.columns-6-6')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.users.index')}}">Users</a></li>
        <li>Delete</li>
    </ul>
@endsection

@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'User info'])            
        @if ($user->avatar)
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

    @wrapper('admin.partials.widget', ['title' => 'Remove user'])
        <p class="alert alert-danger">Are you sure you want to permamently delete this account from system's database?</p>
        
        {!! Form::open(['method' => 'DELETE', 'action' => ['admin\UsersController@destroy', $user->id]]) !!}
        
        <div class="form-group">
            <a href="{{route('admin.users.index')}}" role="button" class="btn btn-success">Go back</a>
            {!! Form::submit('Delete permamently', ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    @endwrapper
@endsection

@section('content-right')
    @wrapper('admin.partials.widget', ['title' => 'Recent actions'])
        @include('admin.partials.logs')
    @endwrapper
@endsection