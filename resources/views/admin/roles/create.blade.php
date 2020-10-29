@extends('admin.layouts.columns-4-8')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li><a href="{{route('admin.users.roles.index')}}">{{ __('admin/routes.roles') }}</a></li>
        <li>{{ __('admin/routes.create') }}</li>
    </ul>
@endsection


@section('before')

    {{-- Open the form --}}
    @if (isset($role))
        {!! Form::model($role, ['method' => 'POST', 'action' => 'Admin\Modules\RolesController@store', 'class' => 'w-100']) !!}
    @else
        {!! Form::open(['method' => 'POST', 'action' => 'Admin\Modules\RolesController@store', 'class' => 'w-100']) !!}
    @endif

@endsection


@section('content-left')
    <x-wrapper title="admin/roles.create_left_title">

        {{-- Validation report --}}
        @include('admin.partials.validation')

        {{-- Display form --}}
        <x-form-fields :fields="$form['left']" />

        {{-- Save button --}}
        <x-create-button />

    </x-wrapper>
@endsection


@section('content-right')
    <x-wrapper title="admin/roles.create_right_title">

        {{-- Display form --}}
        <x-form-fields :fields="$form['right']" />

    </x-wrapper>
@endsection


@section('after')

    {{-- Close the form --}}
    {!! Form::close() !!}

@endsection
