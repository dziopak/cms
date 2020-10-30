@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.posts.index')}}">{{ __('admin/routes.posts') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')

    {{-- Open the form --}}
    {!! Form::model($post, ['method' => 'PATCH', 'action' => ['Admin\Modules\PostsController@update', $post->id], 'class' => 'w-100', 'files' => 'true']) !!}

    {{-- Validation report --}}
    <x-form-validation :errors="$errors" />

    {{-- Hooks --}}
    @hook('post_edit_before')
    @hook('post_before')


@endsection


@section('content-left')
    <x-wrapper title="admin/posts.edit_left_title">

        {{-- Display form --}}
        <x-form-fields :fields="$form['left']" />

        {{-- Hooks --}}
        @hook('post_edit_left_content')
        @hook('post_left_content')

        {{-- Save button --}}
        </x-update-button :container="true" />

    </x-wrapper>

@endsection


@section('content-right')
    <x-wrapper title="admin/posts.edit_right_title">

        {{-- Display form --}}
        <x-form-fields :fields="$form['right']" />

        {{-- Hooks --}}
        @hook('post_edit_right_content')
        @hook('post_right_content')

    </x-wrapper>
@endsection


@section('content-bottom')

    {{-- Hidden fields --}}
    {!! Form::hidden('post_id', $post->id) !!}

    {{-- Hooks --}}
    @hook('post_edit_bottom_content')
    @hook('post_bottom_content')

@endsection


@section('after')

    {{-- Close the form --}}
    {!! Form::close() !!}

    {{-- Include TinyMCE Editor --}}
    @include('admin.partials.tinymce')

    {{-- Hooks --}}
    @hook('post_edit_after')
    @hook('post_after')

@endsection
