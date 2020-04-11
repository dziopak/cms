@extends('admin.layouts.columns-6-6')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li><a href="{{route('admin.users.roles.index')}}">{{ __('admin/routes.roles') }}</a></li>
        <li>{{ __('admin/routes.delete') }}</li>
    </ul>
@endsection


@section('content-left')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/roles.delete_top_title'])
        <div style="display: inline-block;">
            <strong>{{$role->name}}</strong><br/>
            {{ __('admin/general.created_at') }}: {{$role->created_at}}<br/>
        </div>
    @endwrapper

    @wrapper('admin.partials.wrapper', ['title' => 'admin/roles.delete_bottom_title'])
        <p class="alert alert-danger">{{ __('admin/roles.delete_information') }}</p>

        {!! Form::open(['method' => 'DELETE', 'action' => ['admin\RolesController@destroy', $role->id]]) !!}

        <div class="form-group">
            <a href="{{route('admin.users.roles.index')}}" role="button" class="btn btn-success">{{ __('admin/general.back_button') }}</a>
            {!! Form::submit(__('admin/general.delete_permamently'), ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    @endwrapper
@endsection


@section('content-right')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/roles.delete_right_title'])
        {{-- // TO DO // --}}
    @endwrapper
@endsection
