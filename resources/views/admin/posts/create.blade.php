@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.posts.index')}}">{{ __('admin/routes.posts') }}</a></li>
        <li>{{ __('admin/routes.create') }}</li>
    </ul>
@endsection


@section('before')

    {{-- Open the form --}}
    {!! Form::open(['method' => 'POST', 'action' => 'Admin\Modules\PostsController@store', 'class' => 'w-100', 'files' => 'true']) !!}

    {{-- Validation report --}}
    <x-form-validation :errors="$errors" />

@endsection


@section('content-left')
    <x-wrapper title="admin/posts.create_left_title">

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
        <x-form-fields :fields="$form['relations']" />

        <div id="category-list" class="mt-4">
            {!! Form::label('category', 'Przydzielone kategorie: ') !!}<br/>
        </div>

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

    {{-- Close the form  --}}
    {!! Form::close() !!}

    {{-- Include TinyMCE Editor --}}
    @include('admin.partials.tinymce')

@endsection
