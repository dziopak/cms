@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul class="breadcrumbs">
        <li><a href="{{ route('admin.dashboard.index') }}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{ route('admin.settings.general.index') }}">{{ __('admin/routes.settings') }}</a></li>
        <li>General</li>
    </ul>
@endsection


@section('content-left')


    {{-- Open the form --}}
    {!! Form::open(['method' => 'POST', 'action' => 'Admin\Modules\SettingsController@store']) !!}

    <x-wrapper title="admin/settings.general_title">

        {{-- Information --}}
        <p>{{ __('admin/settings.general_description') }}</p>

        {{-- Display form --}}
        <x-form-fields :fields="$form['basic_data']" />

        {{-- Save button --}}
        <x-update-button />

    </x-wrapper>

    {{-- Close the form --}}
    {!! Form::close() !!}


@endsection
