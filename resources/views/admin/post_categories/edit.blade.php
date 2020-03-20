@extends('layouts.admin.containers.columns-8-4')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.posts.index')}}">Posts</a></li>
        <li><a href="{{route('admin.posts.categories.index')}}">Posts</a></li>
        <li>Edit</li>
    </ul>
@endsection


@section('before')
    {!! Form::model($category, ['method' => 'PATCH', 'action' => ['admin\PostCategoriesController@update', $category->id], 'class' => 'w-100', 'files' => 'true']) !!}
    @include('admin.partials.validation')
@endsection


@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'Basic category data'])
        
        @include('partials.form-fields', ['fields' => $form['left']])

        <!-- Custom field hooks -->
        @hook('post_category_edit_left_content')
        @hook('post_category_left_content')
        @hook('category_left_content')
        <!-- End of field hooks -->
        
        <div class="form-group">
            {!! Form::hidden('type', 'post') !!}
            {!! Form::hidden('category_id', $category->id) !!}
            {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
        </div>

        @endwrapper
@endsection

@section('after')
    {!! Form::close() !!}
@endsection