@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.pages') }}</a></li>
        <li>{{ __('admin/routes.create') }}</li>
    </ul>
@endsection


@section('before')
    {!! Form::open(['method' => 'POST', 'action' => 'Admin\Modules\PagesController@store', 'class' => 'w-100', 'files' => 'true']) !!}
    @include('admin.partials.validation')
    @hook('page_create_before')
    @hook('page_before')
@endsection


@section('module-content')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/pages.create_left_title'])

        @include('partials.form-fields', ['fields' => $form['left']])
        @hook('page_create_left_content')
        @hook('page_left_content')

    @endwrapper
@endsection


@section('content-right')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/pages.create_right_title'])

        @include('partials.form-fields', ['fields' => $form['right']])
        @hook('page_create_right_content')
        @hook('page_right_content')

    @endwrapper
@endsection


@section('content-bottom')
    <div class="col">
        @wrapper('admin.partials.wrapper', ['title' => 'admin/pages.create_bottom_title'])

            @include('partials.form-fields', ['fields' => $form['bottom']])

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    {{ __('admin/general.create_button') }}
                </button>
            </div>

            @hook('page_create_bottom_content')
            @hook('page_bottom_content')
        @endwrapper
    </div>
@endsection


@section('after')
    {!! Form::close() !!}
    @include('admin.partials.tinymce')
    @hook('page_create_after')
    @hook('page_after')
@endsection
