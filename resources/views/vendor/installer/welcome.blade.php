@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.welcome.templateTitle') }}
@endsection

@section('title')
    {{ trans('installer_messages.welcome.title') }}
@endsection

@section('container')
    <p class="header__intro">
        <strong class="header__intro-title">{{__('installer_messages.welcome.title') }}</strong><br />
        {{ trans('installer_messages.welcome.message') }}
    </p>
@endsection


@section('continue')
    <form action="{{ route('LaravelInstaller::setup') }}" method="GET">
        <div id="lang-selector">
            <select name="language">
                <option value="en">English</option>
                <option value="pl">Polski</option>
            </select>

            <button type="submit" class="button">
                {{ __('installer_messages.welcome.next') }}
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </button>
        </div>
    </div>
@endsection
