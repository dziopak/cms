@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul class="breadcrumbs">
        <li><a href="{{ route('admin.dashboard.index') }}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{ route('admin.settings.general.index') }}">{{ __('admin/routes.settings') }}</a></li>
        <li>Content</li>
    </ul>
@endsection


@section('content-left')


    {{-- Open the form --}}
    {!! Form::open(['method' => 'POST', 'action' => 'Admin\Modules\ContentSettingsController@store']) !!}

    <x-wrapper title="admin/settings.content_title">

        {{-- Information --}}
        <p>{{ __('admin/settings.content_description') }}</p>
        <hr/>

        {{-- Posts section --}}
        <strong>{{ __('admin/settings.content.posts_title') }}</strong>
        <p>{{ __('admin/settings.content.posts_description') }}</p>
        <x-form-fields :fields="$form['posts']" />
        <hr/>

        {{-- Pages section --}}
        <strong>{{ __('admin/settings.content.pages_title') }}</strong>
        <p>{{ __('admin/settings.content.pages_description') }}</p>
        <x-form-fields :fields="$form['pages']" />


        {{-- Save button --}}
        <x-update-button />

    </x-wrapper>

    {{-- Close the form --}}
    {!! Form::close() !!}


@endsection
