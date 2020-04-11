@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul class="breadcrumbs">
        <li><a href="{{ route('admin.dashboard.index') }}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{ route('admin.settings.general.index') }}">{{ __('admin/routes.settings') }}</a></li>
        <li>General</li>
    </ul>
@endsection


@section('content-left')
    {!! Form::open(['method' => 'POST', 'action' => 'admin\GeneralSettingsController@store']) !!}
    @wrapper('admin.partials.wrapper', ['title' => 'admin/settings.general_title'])


        <p>{{ __('admin/settings.general_description') }}</p>
        @include('partials.form-fields', ['fields' => $form['basic_data']])

        {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success mt-4', 'type' => 'submit']) !!}

    @endwrapper
    {!! Form::close() !!}
@endsection
