@extends('layouts.admin.containers.columns-8-4')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.posts.index')}}">{{ __('admin/routes.posts') }}</a></li>
        <li>{{ __('admin/routes.create') }}</li>
    </ul>
@endsection


@section('before')
    {!! Form::open(['method' => 'POST', 'action' => 'admin\PostsController@store', 'class' => 'w-100', 'files' => 'true']) !!}
    @include('admin.partials.validation')
    @hook('post_edit_before')
    @hook('post_before')
@endsection


@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'admin/posts.create_left_title'])
    
        @include('partials.form-fields', ['fields' => $form['left']])
        @hook('post_create_left_content')
        @hook('post_left_content')

    @endwrapper
@endsection

@section('content-right')
    @wrapper('admin.partials.widget', ['title' => 'admin/posts.create_right_title'])
        
        @include('partials.form-fields', ['fields' => $form['right']])
        @hook('post_create_right_content')
        @hook('post_right_content')

    @endwrapper
@endsection
        
@section('content-bottom')
    <div class="col">
        @wrapper('admin.partials.widget', ['title' => 'admin/posts.create_bottom_title'])    
            
            @include('partials.form-fields', ['fields' => $form['bottom']])

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    {{ __('admin/general.create_button') }}
                </button>
            </div>

            @hook('post_edit_bottom_content')
            @hook('post_bottom_content')
            
        @endwrapper
    </div>
@endsection

@section('after')
    {!! Form::close() !!}
    @include('admin.partials.tinymce')
    @hook('post_edit_after')
    @hook('post_after')
@endsection