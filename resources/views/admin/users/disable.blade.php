@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.users.index')}}">Users</a></li>
        <li>Delete</li>
    </ul>
@endsection

@section('content')
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title">
                    <strong>User's info</strong>
                </div>
                
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
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <strong>{{$user->is_active == 1 ? "Block user" : "Unblock user"}}</strong>
                </div>

                <p class="alert alert-warning">Are you sure you want to {{$user->is_active == 1 ? "block" : "unblock"}} user's account?</p>
                
                {!! Form::open(['method' => 'PUT', 'action' => ['AdminUsersController@block', $user->id]]) !!}
                
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
            </div>
        </div>
    </div>
    <div class="col-6">
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