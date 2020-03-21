@extends('layouts.admin.containers.columns-6-6')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li>{{ __('admin/routes.disable') }}</li>
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
    
    @wrapper('admin.partials.widget', ['title' => 'Change user status'])
        <p class="alert alert-warning">Are you sure you want to {{$user->is_active == 1 ? "block" : "unblock"}} user's account?</p>
        
        {!! Form::open(['method' => 'PUT', 'action' => ['admin\UsersController@block', $user->id]]) !!}
        
        <div class="form-group">
            <a href="{{route('admin.users.index')}}" role="button" class="btn btn-primary">Go back</a>
            @if ($user->is_active == 1)
                {!! Form::hidden('is_active', 0) !!}   
                {!! Form::submit("Block user", ['class' => 'btn btn-danger']) !!}
                @else
                {!! Form::hidden('is_active', 1) !!}   
                {!! Form::submit("Unblock user", ['class' => 'btn btn-success']) !!}
            @endif
        </div>
        {!! Form::close() !!}
    @endwrapper
@endsection

@section('content-right')
    @wrapper('admin.partials.widget', ['title' => 'Recent actions'])
        @include('admin.partials.logs')
    @endwrapper
@endsection