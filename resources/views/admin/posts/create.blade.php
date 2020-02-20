@extends('layouts.admin.containers.columns-8-4')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.posts.index')}}">Posts</a></li>
        <li>Create new</li>
    </ul>
@endsection


@section('before')
    {!! Form::open(['method' => 'POST', 'action' => 'admin\PostsController@store', 'class' => 'w-100', 'files' => 'true']) !!}
    @include('admin.partials.validation')
@endsection


@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'Basic post data'])    
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
    @endwrapper
@endsection

@section('content-right')
    @wrapper('admin.partials.widget', ['title' => 'Post settings'])    
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
    @endwrapper
@endsection
        
@section('content-bottom')
    <div class="col">
        @wrapper('admin.partials.widget', ['title' => 'Post content'])    
            <div class="form-group">
                {!! Form::textarea('content', null, ['class' => 'form-control tinymce']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Create post', ['class' => 'btn btn-success']) !!}
            </div>
        @endwrapper
    </div>
@endsection

@section('after')
    {!! Form::close() !!}
    @include('admin.partials.tinymce')
@endsection