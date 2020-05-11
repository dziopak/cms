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
    @include('admin.partials.validation')
@endsection


@section('module-content')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/page_categories.create_left_title'])

        @include('partials.form-fields', ['fields' => $form['left']])

        <!-- Custom field hooks -->
        @hook('page_category_create_left_content')
        @hook('page_category_left_content')
        @hook('category_left_content')
        <!-- End of field hooks -->

        <div class="form-group">
            {!! Form::hidden('type', 'page') !!}
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </button>
        </div>

    @endwrapper
@endsection


@section('after')
    {!! Form::close() !!}
@endsection
