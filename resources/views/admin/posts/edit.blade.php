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
        
        @include('partials.form-fields', ['fields' => $form['left']])
        @hook('post_edit_left_content')
        @hook('post_left_content')

    @endwrapper
@endsection

@section('content-right')
    @wrapper('admin.partials.widget', ['title' => 'Post settings'])

        @include('partials.form-fields', ['fields' => $form['right']])
        @hook('post_edit_right_content')
        @hook('post_right_content')

    @endwrapper
@endsection
        
@section('content-bottom')
    <div class="col">
        @wrapper('admin.partials.widget', ['title' => 'Post content'])
            
            @include('partials.form-fields', ['fields' => $form['bottom']])
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