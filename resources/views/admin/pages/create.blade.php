@extends('layouts.admin.containers.columns-8-4')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.pages.index')}}">Pages</a></li>
        <li>Create new</li>
    </ul>
@endsection


@section('before')
    {!! Form::open(['method' => 'POST', 'action' => 'admin\PagesController@store', 'class' => 'w-100', 'files' => 'true']) !!}
    @include('admin.partials.validation')
    @hook('page_create_before')
    @hook('page_before')
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Basic page data'])
        
        @include('partials.form-fields', ['fields' => $form['left']])
        @hook('page_create_left_content')
        @hook('page_left_content')

    @endwrapper
@endsection


@section('content-right')
    @wrapper('admin.partials.widget', ['title' => 'Page settings'])
    
        @include('partials.form-fields', ['fields' => $form['right']])
        @hook('page_create_right_content')
        @hook('page_right_content')

    @endwrapper
@endsection

@section('content-bottom')
    <div class="col">
        @wrapper('admin.partials.widget', ['title' => 'Page content'])
            
            @include('partials.form-fields', ['fields' => $form['bottom']])

            <div class="form-group">
                {!! Form::submit('Create page', ['class' => 'btn btn-success']) !!}
            </div>

            @hook('page_create_bottom_content')
            @hook('page_bottom_content')
        @endwrapper
    </div>
@endsection


@section('after')
    {!! Form::close() !!}
    @include('admin.partials.tinymce')
    @hook('page_create_after')
    @hook('page_after')
@endsection
