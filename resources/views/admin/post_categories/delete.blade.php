@extends('layouts.admin.containers.columns-6-6')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.posts.index')}}">{{ __('admin/routes.posts') }}</a></li>
        <li><a href="{{route('admin.posts.categories.index')}}">{{ __('admin/routes.categories') }}</a></li>
        <li>{{ __('admin/routes.delete') }}</li>
    </ul>
@endsection

@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'Category info'])
        <div style="display: inline-block;">
            <strong>{{$category->name}} category</strong><br/>
            Created: {{$category->created_at}}<br/>
        </div>
    @endwrapper

    @wrapper('admin.partials.widget', ['title' => 'Remove category'])

        <p class="alert alert-danger">Are you sure you want to permamently delete this category from system's database? This action is irreversible.</p>
        {!! Form::open(['method' => 'DELETE', 'action' => ['admin\PostCategoriesController@destroy', $category->id]]) !!}
        <div class="form-group">
            <a href="{{route('admin.posts.categories.index')}}" role="button" class="btn btn-success">Go back</a>
            {!! Form::submit('Delete permamently', ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    
    @endwrapper
@endsection