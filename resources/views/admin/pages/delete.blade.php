@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.pages.index')}}">Pages</a></li>
        <li>Delete</li>
    </ul>
@endsection

@section('content')
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title">
                    <strong>Page's info</strong>
                </div>
                   
                <div style="display: inline-block;">
                    <strong>{{$page->name}}</strong>
                    <p>{{ $page->excerpt }}</p>
                    Created: {{$page->created_at}}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <strong>Remove Page</strong>
                </div>

                <p class="alert alert-danger">Are you sure you want to permamently delete this page from system's database? This action is irreversible.</p>
                
                {!! Form::open(['method' => 'DELETE', 'action' => ['AdminPagesController@destroy', $page->id]]) !!}
                
                <div class="form-group">
                    <a href="{{route('admin.pages.index')}}" role="button" class="btn btn-success">Go back</a>
                    {!! Form::submit('Delete permamently', ['class' => 'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection