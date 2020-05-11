@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.final.templateTitle') }}
@endsection


@section('title')
{{ __('installer_messages.final.title') }}
@endsection


@section('container')
    <p class="header__intro">{{ __('installer_messages.final.message') }}</p>
    <p style="font-size: 14px; font-weight: bold;">
        {{ __('installer_messages.final.credentials.email') }}<br/>
        {{ __('installer_messages.final.credentials.password') }}<br/>
    </p>
    <small>{{ __('installer_messages.final.credentials_message') }}</small>
@endsection

@section('continue')
    <div class="buttons">
        <a href="{{ url('/') }}/admin" class="button">{{ trans('installer_messages.final.exit') }}</a>
    </div>
@endsection
