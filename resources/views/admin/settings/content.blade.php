@extends('admin.layouts.columns-4-8')


@section('breadcrumbs')
    <ul class="breadcrumbs">
        <x-crumb route="admin.dashboard.index" name="admin/routes.admin" />
        <x-crumb route="admin.settings.general" name="admin/routes.settings" />
        <x-crumb name="admin/routes.content" />
    </ul>
@endsection


@section('content-left')

    {{-- Open the form --}}
    {!! Form::open(['method' => 'POST', 'action' => 'Admin\Modules\ContentSettingsController@store']) !!}

    <x-wrapper title="admin/settings.content_title">

        {{-- Information --}}
        <p class="mb-4">{{ __('admin/settings.content_description') }}</p>

        {{-- Save button --}}
        <x-update-button />

    </x-wrapper>
@endsection


@section('content-right')

    {{-- Homepage section --}}
    <x-wrapper title="admin/settings.content.home.title">
        <p>{{ __('admin/settings.content.home.description') }}</p>
        <x-form-fields :fields="$form['home']" />
    </x-wrapper>

    {{-- Posts section --}}
    <x-wrapper title="admin/settings.content.posts.title">
        <p>{{ __('admin/settings.content.posts.description') }}</p>
        <x-form-fields :fields="$form['posts']" />
    </x-wrapper>

    {{-- Pages section --}}
    <x-wrapper title="admin/settings.content.pages.title">
        <p>{{ __('admin/settings.content.pages.description') }}</p>
        <x-form-fields :fields="$form['pages']" />
    </x-wrapper>

    {{-- Users section --}}
    <x-wrapper title="admin/settings.content.users.title">
        <p>{{ __('admin/settings.content.users.description') }}</p>
        <x-form-fields :fields="$form['users']" />
    </x-wrapper>

    {{-- Close the form --}}
    {!! Form::close() !!}

@endsection
