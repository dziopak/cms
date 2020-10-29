@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.pages') }}</a></li>
        <li>{{ __('admin/routes.create') }}</li>
    </ul>
@endsection


@section('before')


    {{-- Open form --}}
    {!! Form::open(['method' => 'POST', 'action' => 'Admin\Modules\PagesController@store', 'class' => 'w-100', 'files' => 'true']) !!}

    {{-- Validation report --}}
    @include('admin.partials.validation')

    {{-- Hooks --}}
    @hook('page_create_before')
    @hook('page_before')


@endsection


@section('module-content')
    <x-wrapper title="admin/pages.create_left_title">


        {{-- Display form --}}
        <x-form-fields :fields="$form['left']" />

        {{-- Hooks --}}
        @hook('page_create_left_content')
        @hook('page_left_content')

        {{-- Save button --}}
        <x-create-button />


    </x-wrapper>
@endsection


@section('content-right')
    <x-wrapper title="admin/pages.create_right_title">


        {{-- Display form --}}
        <x-form-fields :fields="$form['right']" />

        {{-- Hooks --}}
        @hook('page_create_right_content')
        @hook('page_right_content')


    </x-wrapper>
@endsection


@section('content-bottom')

    {{-- Hooks --}}
    @hook('page_create_bottom_content')
    @hook('page_bottom_content')

@endsection


@section('after')

    {{-- Close the form --}}
    {!! Form::close() !!}

    {{-- Include TinyMCE Editor --}}
    @include('admin.partials.tinymce')

    {{-- Hooks --}}
    @hook('page_create_after')
    @hook('page_after')


@endsection
