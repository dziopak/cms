@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.posts.index')}}">Posts</a></li>
        <li><a href="{{route('admin.posts.categories.index')}}">Posts</a></li>
        <li>Edit</li>
    </ul>
@endsection

@section('content')
    <div class="col-12">
    {!! Form::model($category, ['method' => 'PATCH', 'action' => ['admin\PostCategoriesController@update', $category->id], 'class' => 'w-100 col-12', 'files' => 'true']) !!}

        @include('admin.partials.validation')
    
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="card-title">
                            <strong>Basic category data</strong>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                {!! Form::label('name', 'Post\'s name: ', ['class' => 'required']) !!}
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
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    </div>
@endsection