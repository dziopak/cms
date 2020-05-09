@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.menu.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-cog fa-fw" aria-hidden="true"></i>
    {!! trans('installer_messages.environment.menu.title') !!}
@endsection

@section('container')

    <p class="header__intro">
        <strong class="header__intro-title">{{__('installer_messages.environment.menu.title') }}</strong><br />
        {!! trans('installer_messages.environment.menu.desc') !!}
    </p>

    <p class="text-center">
    </p>

@endsection


@section('continue')
    <div class="buttons">
        <a href="{{ route('LaravelInstaller::environmentWizard') }}" class="button button-wizard">
            <i class="fa fa-sliders fa-fw" aria-hidden="true"></i> {{ trans('installer_messages.environment.menu.wizard-button') }}
        </a>
        <a href="{{ route('LaravelInstaller::environmentClassic') }}" class="button button-classic">
            <i class="fa fa-code fa-fw" aria-hidden="true"></i> {{ trans('installer_messages.environment.menu.classic-button') }}
        </a>
    </div>
@endsection
