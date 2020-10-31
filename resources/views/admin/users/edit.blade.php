@extends('admin.layouts.columns-6-6')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('content-left')
    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['Admin\Modules\UsersController@update', $user->id], 'files' => 'true']) !!}

        <x-wrapper title="admin/users.edit_right_title">

            {{-- Display profile --}}
            <x-user-profile :user="$user" />

        </x-wrapper>

        <x-wrapper title="admin/users.edit_left_title">

            {{-- Validation report --}}
            <x-form-validation :errors="$errors" />

            {{-- Display form --}}
            <x-form-fields :fields="$form['basic_data']" />

            {{-- Hidden fields --}}
            <input type="hidden" value="{{$user->id}}" name="user_id" />

            {{-- Save button --}}
            <x-update-button />

        </x-wrapper>
    {!! Form::close() !!}
@endsection


@section('content-right')

    <x-wrapper title="admin/users.change_password">

        {{-- Open the form --}}
        {!! Form::open(['method' => 'PUT', 'action' => ['Admin\Modules\UsersController@password', $user->id]]) !!}

        {{-- Display form --}}
        <x-form-fields :fields="$form['password_change']" />

        {{-- Save button --}}
        <x-update-button />

        {{-- Close the form --}}
        {!! Form::close() !!}

    </x-wrapper>


    <x-wrapper title="admin/users.recent_actions">

        {{-- Display logs --}}
        <x-logs :data="$logs" />

    </x-wrapper>

@endsection
