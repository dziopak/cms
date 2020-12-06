@extends('admin.templates.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li>{{ __('admin/routes.create') }}</li>
    </ul>
@endsection


@section('before')
    {{-- Open the form  --}}
    {!! Form::open(['method' => 'POST', 'action' => 'Admin\Modules\Users\UsersController@store', 'files' => 'true']) !!}
@endsection


@section('content-left')
    <x-wrapper title="admin/users.create_left_title">


        {{-- Validation report --}}
        <x-form-validation :errors="$errors" />

        {{-- Display form --}}
        <x-form-fields :fields="$form['left']" />

        {{-- Save button --}}
        <x-create-button />


    </x-wrapper>
@endsection


@section('content-right')
    <x-wrapper title="admin/users.create_right_title">


        {{-- Validation report --}}
        <x-form-validation :errors="$errors" />

        {{-- Display form --}}
        <x-form-fields :fields="$form['right']" />


    </x-wrapper>
@endsection


@section('after')

    {{-- Close the form --}}
    {!! Form::close() !!}

@endsection
