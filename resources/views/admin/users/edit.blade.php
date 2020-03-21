@extends('layouts.admin.containers.columns-6-6')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection

@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'admin/users.edit_left_title'])
        {!! Form::model($user, ['method' => 'PATCH', 'action' => ['admin\UsersController@update', $user->id], 'files' => 'true']) !!}
        
        @include('admin.partials.validation')
        @include('partials.form-fields', ['fields' => $form['left']])
        
        
        <div class="form-group">
            <input type="hidden" value="{{$user->id}}" name="user_id" />
            {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
        </div>
        
        {!! Form::close() !!}
    @endwrapper
@endsection

@section('content-right')    
    @wrapper('admin.partials.widget', ['title' => 'admin/users.edit_right_title'])
        @if ($user->photo)
            <img class="rounded-circle mr-4 float-left" width="100" src="{{ getPublicPath() }}/images/{{$user->photo->path}}">
        @endif

        <div style="display: inline-block;">
            <strong>{{'@'.$user->name}}</strong><br/>
            
            @if ($user->first_name && $user->last_name)
                <span>{{$user->first_name.' '.$user->last_name}}</span><br/>
            @endif
            
            {{ __('admin/general.created_at') }} {{$user->created_at}}<br/>
            <small>{{$user->role->name}}</small>
        </div>
    @endwrapper

    @wrapper('admin.partials.widget', ['title' => 'admin/users.recent_actions'])
        @include('admin.partials.logs')
    @endwrapper

    @wrapper('admin.partials.widget', ['title' => 'admin/users.change_password'])
        {!! Form::open(['method' => 'PUT', 'action' => ['admin\UsersController@password', $user->id]]) !!}
        
        @include('partials.form-fields', ['fields' => $form['right']])

        {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        {!! Form::close() !!}
    @endwrapper
@endsection