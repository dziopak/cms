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
    {!! Form::model($category, ['method' => 'PATCH', 'action' => ['Admin\Modules\PostCategoriesController@update', $category->id], 'class' => 'w-100', 'files' => 'true']) !!}
    @include('admin.partials.validation')
@endsection


@section('content-left')
    <x-wrapper title="admin/post_categories.edit_left_title">

        @include('partials.form-fields', ['fields' => $form['left']])

        <!-- Custom field hooks -->
        @hook('post_category_edit_left_content')
        @hook('post_category_left_content')
        @hook('category_left_content')
        <!-- End of field hooks -->

        <div class="form-group">
            {!! Form::hidden('type', 'post') !!}
            {!! Form::hidden('category_id', $category->id) !!}
            {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
        </div>

    </x-wrapper>
@endsection


@section('after')
    {!! Form::close() !!}
@endsection
