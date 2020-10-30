@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.pages') }}</a></li>
        <li><a href="{{route('admin.pages.categories.index')}}">{{ __('admin/routes.categories') }}</a></li>
        <li>{{ __('admin/routes.create') }}</li>
    </ul>
@endsection


@section('before')
    {!! Form::open(['method' => 'POST', 'action' => 'Admin\Modules\PageCategoriesController@store', 'class' => 'w-100', 'files' => 'true']) !!}
    <x-form-validation :errors="$errors" />
@endsection


@section('module-content')
    <x-wrapper title="admin/page_categories.create_left_title">

        {{-- Display form --}}
        <x-form-fields :fields="$form['left']" />
        {!! Form::hidden('type', 'page') !!}

        {{-- Hooks --}}
        @hook('page_category_create_left_content')
        @hook('page_category_left_content')
        @hook('category_left_content')

        {{-- Save button --}}
        <div class="form-group">
            <x-create-button />
        </div>

    </x-wrapper>
@endsection


@section('after')
    {!! Form::close() !!}
@endsection
