@extends('layouts.admin.containers.columns-8-4')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.pages.index')}}">Pages</a></li>
        <li><a href="{{route('admin.pages.categories.index')}}">Pages</a></li>
        <li>Create new</li>
    </ul>
@endsection


@section('before')
    {!! Form::open(['method' => 'POST', 'action' => 'admin\PageCategoriesController@store', 'class' => 'w-100', 'files' => 'true']) !!}
    @include('admin.partials.validation')
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Basic category data'])
        
        @include('partials.form-fields', ['fields' => $form['left']])
    
        <!-- Custom field hooks -->
        @hook('page_category_create_left_content')
        @hook('page_category_left_content')
        @hook('category_left_content')
        <!-- End of field hooks -->

        <div class="form-group">
            {!! Form::hidden('type', 'page') !!}
            {!! Form::submit('Create category', ['class' => 'btn btn-success']) !!}
        </div>

    @endwrapper
@endsection


@section('after')
    {!! Form::close() !!}
@endsection