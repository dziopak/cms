@extends('admin.templates.columns-4-8')


{{-- Breadcrumbs --}}
@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li><a href="{{route('admin.users.roles.index')}}">{{ __('admin/routes.roles') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')

    {{-- Open the form --}}
    {!! Form::model($role, ['method' => 'PATCH', 'action' => ['Admin\Modules\Roles\RolesController@update', $role->id]]) !!}

@endsection


@section('content-left')
    <x-wrapper title="admin/roles.edit_left_title">

        {{-- Validation report --}}
        <x-form-validation :errors="$errors" />

        {{-- Display form --}}
        <x-form-fields :fields="$form['left']" />

        {{-- Save button --}}
        <x-update-button :container="true" />

    </x-wrapper>
@endsection


@section('content-right')
    <x-wrapper title="admin/roles.edit_right_title">

        {{-- Display form --}}
        <x-form-fields :fields="$form['right']" />

    </x-wrapper>
@endsection


@section('after')

    {{-- Close the form --}}
    {!! Form::close() !!}

@endsection
