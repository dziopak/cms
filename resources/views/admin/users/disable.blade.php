@extends('admin.templates.columns-6-6')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li>{{ __('admin/routes.disable') }}</li>
    </ul>
@endsection


@section('content-left')
    <x-wrapper title="admin/users.disable_top_title">

        <x-user-profile :user="$user" />

    </x-wrapper>

    <x-wrapper title="admin/users.disable_bottom_title">
        <p class="alert alert-warning">
        {{$user->is_active == 1 ? __('admin/users.disable_information') : __('admin/users.enable_information') }}
        </p>

        {!! Form::open(['method' => 'PUT', 'action' => ['Admin\Modules\Users\UserStatusController@update', $user->id]]) !!}

        <div class="form-group">
            <a href="{{route('admin.users.index')}}" role="button" class="btn btn-success">{{ __('admin/general.back_button') }}</a>
            @if ($user->is_active == 1)
                {!! Form::hidden('is_active', 0) !!}
                {!! Form::submit(__('admin/users.disable_button'), ['class' => 'btn btn-danger']) !!}
                @else
                {!! Form::hidden('is_active', 1) !!}
                {!! Form::submit(__('admin/users.enable_button'), ['class' => 'btn btn-success']) !!}
            @endif
        </div>
        {!! Form::close() !!}
    </x-wrapper>
@endsection


@section('content-right')
    <x-wrapper title="admin/users.recent_actions">
        <x-logs :data="$logs" />
    </x-wrapper>
@endsection
