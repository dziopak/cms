@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.pages') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')

    {{-- Open the form --}}
    {!! Form::model($page, ['method' => 'PATCH', 'action' => ['Admin\Modules\PagesController@update', $page->id], 'class' => 'w-100', 'files' => 'true']) !!}

    {{-- Validation report --}}
    <x-form-validation :errors="$errors" />

    {{-- Hooks --}}
    @hook('page_edit_before')
    @hook('page_before')

@endsection


@section('content-left')
    <x-wrapper title="admin/pages.edit_left_title">

        {{-- Display form --}}
        <x-form-fields :fields="$form['left']" />

        {{-- Hooks --}}
        @hook('page_edit_left_content')
        @hook('page_left_content')

        {{-- Save button --}}
        <x-update-button :container="true" />

    </x-wrapper>
@endsection


@section('content-right')
    <x-wrapper title="admin/pages.edit_right_title">

        {{-- Display form --}}
        <x-form-fields :fields="$form['right']" />

        {{-- Hooks --}}
        @hook('page_edit_right_content')
        @hook('page_right_content')

    </x-wrapper>
@endsection


@section('content-bottom')

    {{-- Hidden fields --}}
    {!! Form::hidden('page_id', $page->id) !!}

    {{-- Hooks --}}
    @hook('page_edit_bottom_content')
    @hook('page_bottom_content')

@endsection


@section('after')

    {{-- Close the form --}}
    {!! Form::close() !!}

    {{-- Include TinyMCE Editor --}}
    @include('admin.partials.tinymce')

    {{-- Hooks --}}
    @hook('page_edit_after')
    @hook('page_after')

@endsection
