@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.posts.index')}}">Posts</a></li>
        <li>Create new</li>
    </ul>
@endsection

@section('content')
    <div class="col-12">
    {!! Form::open(['method' => 'POST', 'action' => 'admin\PostsController@store', 'class' => 'w-100 col-12', 'files' => 'true']) !!}

        @include('admin.partials.validation')
    
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="card-title">
                            <strong>Basic post data</strong>
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
                            {!! Form::label('category_id', 'Post\'s category: ') !!}
                            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                {!! Form::label('excerpt', 'Excerpt: ', ['class' => 'required']) !!}
                                {!! Form::textarea('excerpt', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="card-title">
                            <strong>Post settings</strong>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                {!! Form::label('thumbnail', 'Thumbnail: ') !!}
                                {!! Form::file('thumbnail', ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                {!! Form::label('meta_title', 'Meta title: ') !!}
                                {!! Form::text('meta_title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                {!! Form::label('meta_description', 'Meta description: ') !!}
                                {!! Form::textarea('meta_description', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="card-title">
                            <strong>Post content</strong>
                        </div>

                        <div class="form-group">
                            {!! Form::textarea('content', null, ['class' => 'form-control tinymce']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Create post', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    </div>
    @include('admin.partials.tinymce')
@endsection
