@extends('layouts.admin.containers.columns-8-4')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.pages.index')}}">Pages</a></li>
        <li><a href="{{route('admin.pages.categories.index')}}">Categories</a></li>
        <li>Edit</li>
    </ul>
@endsection


@section('before')
    {!! Form::model($category, ['method' => 'PATCH', 'action' => ['admin\PageCategoriesController@update', $category->id], 'class' => 'w-100']) !!}
    @include('admin.partials.validation')
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Basic category data'])
        
        @include('partials.form-fields', ['fields' => $form['left']])

        <!-- Custom field hooks -->
        @hook('page_category_edit_left_content')
        @hook('page_category_left_content')
        @hook('category_left_content')
        <!-- End of field hooks -->

        <div class="form-group">
            {!! Form::hidden('type', 'page') !!}
            {!! Form::hidden('category_id', $category->id) !!}
            {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
        </div>
    @endwrapper
@endsection


@section('after')
    {!! Form::close() !!}
@endsection
