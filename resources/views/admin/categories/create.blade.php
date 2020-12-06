@extends('admin.templates.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.categories.index')}}">{{ __('admin/routes.categories') }}</a></li>
        <li>{{ __('admin/routes.create') }}</li>
    </ul>
@endsection


@section('before')
    {!! Form::open(['method' => 'POST', 'action' => 'Admin\Modules\Categories\CategoriesController@store', 'class' => 'w-100', 'files' => 'true']) !!}
    <x-form-validation :errors="$errors" />
@endsection


@section('module-content')
    <x-wrapper title="admin/page_categories.create_left_title">

        {{-- Display form --}}
        <x-form-fields :fields="$form['left']" />

        {{-- Save button --}}
        <div class="form-group">
            <x-create-button />
        </div>

    </x-wrapper>
@endsection


@section('after')
    {!! Form::close() !!}
@endsection
