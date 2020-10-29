@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.posts.index')}}">{{ __('admin/routes.posts') }}</a></li>
        <li><a href="{{route('admin.posts.categories.index')}}">{{ __('admin/routes.categories') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')

    {{-- Open the form  --}}
    {!! Form::model($category, ['method' => 'PATCH', 'action' => ['Admin\Modules\PostCategoriesController@update', $category->id], 'class' => 'w-100', 'files' => 'true']) !!}

    {{-- Validation report --}}
    @include('admin.partials.validation')

@endsection


@section('content-left')
    <x-wrapper title="admin/post_categories.edit_left_title">

        {{-- Display form --}}
        <x-form-fields :fields="$form['left']" />

        {{-- Hidden fields --}}
        {!! Form::hidden('type', 'post') !!}
        {!! Form::hidden('category_id', $category->id) !!}

        {{-- Hooks --}}
        @hook('post_category_edit_left_content')
        @hook('post_category_left_content')
        @hook('category_left_content')

        {{-- Save button --}}
        <x-update-button :container="true" />

    </x-wrapper>
@endsection


@section('after')
    {!! Form::close() !!}
@endsection
