@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.posts.index')}}">{{ __('admin/routes.posts') }}</a></li>
        <li><a href="{{route('admin.posts.categories.index')}}">{{ __('admin/routes.categories') }}</a></li>
        <li>{{ __('admin/routes.create') }}</li>
    </ul>
@endsection


@section('before')


    {{-- Open form --}}
    {!! Form::open(['method' => 'POST', 'action' => 'Admin\Modules\PostCategoriesController@store', 'class' => 'w-100 col-12', 'files' => 'true']) !!}

    {{-- Validation report --}}
    <x-form-validation :errors="$errors" />


@endsection


@section('content-left')
    <x-wrapper title="admin/post_categories.create_left_title">


        {{-- Display form --}}
        <x-form-fields :fields="$form['left']" />

        {{-- Hooks --}}
        @hook('post_category_create_left_content')
        @hook('post_category_left_content')
        @hook('category_left_content')

        {{-- Create button --}}
        <x-create-button />

    </x-wrapper>
@endsection


@section('after')

    {{-- Close the form --}}
    {!! Form::close() !!}

@endsection
