@extends('layouts.admin.containers.columns-8-4')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.posts.index')}}">Posts</a></li>
        <li>Edit</li>
    </ul>
@endsection


@section('before')
    {!! Form::model($post, ['method' => 'PATCH', 'action' => ['admin\PostsController@update', $post->id], 'class' => 'w-100', 'files' => 'true']) !!}
    @include('admin.partials.validation')
    @hook('post_edit_before')
    @hook('post_before')
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

        @hook('post_edit_left_content')
        @hook('post_left_content')
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
        
        <div class="form-group">
            <div class="form-check">
                {!! Form::checkbox('index', '1', null, ['class' => 'form-check-input']) !!}
                {!! Form::label('index', 'Index page', ['class' => 'form-check-label']) !!}
            </div>
            <div class="form-check">
                {!! Form::checkbox('follow', '1', null, ['class' => 'form-check-input']) !!}
                {!! Form::label('follow', 'Follow page', ['class' => 'form-check-label']) !!}
            </div>
        </div>
        @hook('post_edit_right_content')
        @hook('post_right_content')
    @endwrapper
@endsection
        
@section('content-bottom')
    <div class="col">
        @wrapper('admin.partials.widget', ['title' => 'Post content'])
            <div class="form-group">
                {!! Form::textarea('content', null, ['class' => 'form-control tinymce']) !!}
            </div>

            @hook('post_edit_bottom_content')
            @hook('post_bottom_content')

            <div class="form-group">
                {!! Form::hidden('post_id', $post->id) !!}
                {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
            </div>
        @endwrapper                
    </div>
@endsection

@section('after')
    {!! Form::close() !!}
    @include('admin.partials.tinymce')
    @hook('post_edit_after')
    @hook('post_after')
@endsection