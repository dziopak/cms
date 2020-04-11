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
    {!! Form::open(['method' => 'POST', 'action' => 'admin\PostCategoriesController@store', 'class' => 'w-100 col-12', 'files' => 'true']) !!}
    @include('admin.partials.validation')
@endsection


@section('content-left')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/post_categories.create_left_title'])

        @include('partials.form-fields', ['fields' => $form['left']])

        <!-- Custom field hooks -->
        @hook('post_category_create_left_content')
        @hook('post_category_left_content')
        @hook('category_left_content')
        <!-- End of field hooks -->

        <div class="form-group">
            {!! Form::hidden('type', 'post') !!}
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
