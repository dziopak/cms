@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.pages.index')}}">Pages</a></li>
        <li><a href="{{route('admin.pages.categories.index')}}">Categories</a></li>
        <li>Delete</li>
    </ul>
@endsection

@section('content')
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title">
                    <strong>Category info</strong>
                </div>
                   
                <div style="display: inline-block;">
                    <strong>{{$category->name}} category</strong><br/>
                    Created: {{$category->created_at}}<br/>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <strong>Remove category</strong>
                </div>

                <p class="alert alert-danger">Are you sure you want to permamently delete this category from system's database? This action is irreversible.</p>
                
                {!! Form::open(['method' => 'DELETE', 'action' => ['AdminPageCategoriesController@destroy', $category->id]]) !!}
                
                <div class="form-group">
                    <a href="{{route('admin.pages.categories.index')}}" role="button" class="btn btn-success">Go back</a>
                    {!! Form::submit('Delete permamently', ['class' => 'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection