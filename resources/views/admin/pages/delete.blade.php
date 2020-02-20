@extends('layouts.admin.containers.columns-6-6')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.pages.index')}}">Pages</a></li>
        <li>Delete</li>
    </ul>
@endsection

@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'Page info'])
        <div style="display: inline-block;">
            <strong>{{$page->name}}</strong>
            <p>{{ $page->excerpt }}</p>
            Created: {{$page->created_at}}
        </div>
    @endwrapper

    @wrapper('admin.partials.widget', ['title' => 'Remove page'])
        <p class="alert alert-danger">Are you sure you want to permamently delete this page from system's database? This action is irreversible.</p>
        
        {!! Form::open(['method' => 'DELETE', 'action' => ['admin\PagesController@destroy', $page->id]]) !!}
        
        <div class="form-group">
            <a href="{{route('admin.pages.index')}}" role="button" class="btn btn-success">Go back</a>
            {!! Form::submit('Delete permamently', ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    @endwrapper
@endsection