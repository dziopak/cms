@extends('admin.layouts.columns-6-6')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li>{{ __('admin/routes.delete') }}</li>
    </ul>
@endsection


@section('content-left')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/users.delete_top_title'])
        @if ($user->avatar)
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

    @wrapper('admin.partials.wrapper', ['title' => 'admin/users.delete_bottom_title'])
        <p class="alert alert-danger">{{ __('admin/users.delete_information') }}</p>

        {!! Form::open(['method' => 'DELETE', 'action' => ['admin\UsersController@destroy', $user->id]]) !!}

        <div class="form-group">
            <a href="{{route('admin.users.index')}}" role="button" class="btn btn-success">{{ __('admin/general.back_button') }}</a>
            {!! Form::submit(__('admin/general.delete_permamently'), ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    @endwrapper
@endsection


@section('content-right')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/users.recent_actions'])
        @include('admin.partials.logs')
    @endwrapper
@endsection
