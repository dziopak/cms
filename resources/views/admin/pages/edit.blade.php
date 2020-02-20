@extends('layouts.admin.containers.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.pages.index')}}">Pages</a></li>
        <li>Edit</li>
    </ul>
@endsection

@section('before')
    {!! Form::model($page, ['method' => 'PATCH', 'action' => ['admin\PagesController@update', $page->id], 'class' => 'w-100', 'files' => 'true']) !!}
    @include('admin.partials.validation')
@endsection


@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'Basic page data'])
        <div class="form-group row">
            <div class="col">
                {!! Form::label('name', 'Page\'s name: ', ['class' => 'required']) !!}
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
            {!! Form::label('category_id', 'Page\'s category: ') !!}
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
    @wrapper('admin.partials.widget', ['title' => 'Page settings'])
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
                {!! Form::hidden('index', '0') !!}
                {!! Form::checkbox('index', '1', null, ['class' => 'form-check-input']) !!}
                {!! Form::label('index', 'Index page', ['class' => 'form-check-label']) !!}
            </div>
            <div class="form-check">
                {!! Form::hidden('follow', '0') !!}
                {!! Form::checkbox('follow', '1', null, ['class' => 'form-check-input']) !!}
                {!! Form::label('follow', 'Follow page', ['class' => 'form-check-label']) !!}
            </div>
        </div>
    @endwrapper
@endsection


@section('content-bottom')
    <div class="col">
        @wrapper('admin.partials.widget', ['title' => 'Page content'])
            <div class="form-group">
                {!! Form::textarea('content', null, ['class' => 'form-control tinymce']) !!}
            </div>

            <div class="form-group">
                {!! Form::hidden('page_id', $page->id) !!}
                {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
            </div>
        @endwrapper
    </div>
@endsection


@section('after')
    {!! Form::close() !!}
    @include('admin.partials.tinymce')
@endsection