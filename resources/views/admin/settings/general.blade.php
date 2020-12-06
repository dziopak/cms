@extends('admin.templates.columns-8-4')


@section('breadcrumbs')
    <ul class="breadcrumbs">
        <x-crumb route="admin.dashboard.index" name="admin/routes.admin" />
        <x-crumb route="admin.settings.general" name="admin/routes.settings" />
        <x-crumb name="admin/routes.general" />
    </ul>
@endsection


@section('content-left')


    {{-- Open the form --}}
    {!! Form::open(['method' => 'POST', 'action' => 'Admin\Modules\Settings\GeneralSettingsController@store']) !!}

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
