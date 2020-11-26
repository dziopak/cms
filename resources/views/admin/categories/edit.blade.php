@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.categories.index')}}">{{ __('admin/routes.categories') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')
    {!! Form::model($category, ['method' => 'PATCH', 'action' => ['Admin\Modules\CategoriesController@update', $category->id], 'class' => 'w-100']) !!}
    <x-form-validation :errors="$errors" />
@endsection


@section('module-content')
    <x-wrapper title="admin/categories.edit_left_title">

        {{-- Display form --}}
        <x-form-fields :fields="$form['left']" />

        {{-- Hidden fields --}}
        {!! Form::hidden('category_id', $category->id) !!}

        {{-- Save button --}}
        <x-update-button :container="true" />

    </x-wrapper>
@endsection


@section('after')
    {!! Form::close() !!}
@endsection
