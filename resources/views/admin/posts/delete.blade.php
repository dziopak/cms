@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.posts.index')}}">Posts</a></li>
        <li>Delete</li>
    </ul>
@endsection

@section('content')
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title">
                    <strong>Post's info</strong>
                </div>
                   
                <div style="display: inline-block;">
                    <strong>{{$post->name}}</strong>
                    <p>{{ $post->excerpt }}</p>
                    Created: {{$post->created_at}}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <strong>Remove Post</strong>
                </div>

                <p class="alert alert-danger">Are you sure you want to permamently delete this post from system's database? This action is irreversible.</p>
                
                {!! Form::open(['method' => 'DELETE', 'action' => ['AdminPostsController@destroy', $post->id]]) !!}
                
                <div class="form-group">
                    <a href="{{route('admin.posts.index')}}" role="button" class="btn btn-success">Go back</a>
                    {!! Form::submit('Delete permamently', ['class' => 'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection