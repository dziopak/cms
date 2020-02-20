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
        <div class="form-group row">
            <div class="col">
                {!! Form::label('name', 'Category name: ', ['class' => 'required']) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col">
                {!! Form::label('slug', 'Slug: ', ['class' => 'required']) !!}
                {!! Form::text('slug', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('parent_id', 'Post\'s category: ') !!}
            {!! Form::select('parent_id', $categories, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group row">
            <div class="col">
                {!! Form::label('description', 'Description: ') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>
        </div>

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