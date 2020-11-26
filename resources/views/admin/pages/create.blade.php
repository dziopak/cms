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
    <x-form-validation :errors="$errors" />

@endsection


@section('module-content')
    <x-wrapper title="admin/pages.create_left_title">

        {{-- Display form --}}
        <x-form-fields :fields="$form['left']" />

        {{-- Save button --}}
        <x-create-button />

    </x-wrapper>
@endsection


@section('content-right')

    {{-- Settings --}}
    <x-wrapper title="admin/posts.edit_right_title">
        <x-form-fields :fields="$form['right']" />
    </x-wrapper>


    {{-- Relations --}}
    <x-wrapper title="admin/posts.edit_right_title">

        {{-- Selects --}}
        <x-form-fields :fields="$form['relations']" />

        {{-- Categories --}}
        <div id="category-list" class="mt-4">
            {!! Form::label('category', 'Przydzielone kategorie: ') !!}<br/>
        </div>

        {{-- Tags --}}
        <div id="tag-list" class="mt-4">
            {!! Form::label('tag', 'Przydzielone tagi: ') !!}<br/>
        </div>

    </x-wrapper>


    {{-- SEO --}}
    <x-wrapper title="SEO">
        <x-form-fields :fields="$form['seo']" />
    </x-wrapper>

@endsection


@section('after')

    {{-- Close the form --}}
    {!! Form::close() !!}

    {{-- Include TinyMCE Editor --}}
    @include('admin.partials.tinymce')

@endsection
