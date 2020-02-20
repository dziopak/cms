@extends('layouts.admin.containers.columns-6-6')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.posts.index')}}">Posts</a></li>
        <li>Delete</li>
    </ul>
@endsection

@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'Post info'])                
        <div style="display: inline-block;">
            <strong>{{$post->name}}</strong>
            <p>{{ $post->excerpt }}</p>
            Created: {{$post->created_at}}
        </div>
    @endwrapper
            
    @wrapper('admin.partials.widget', ['title' => 'Remove post'])
        <p class="alert alert-danger">Are you sure you want to permamently delete this post from system's database? This action is irreversible.</p>
        
        {!! Form::open(['method' => 'DELETE', 'action' => ['admin\PostsController@destroy', $post->id]]) !!}
        
        <div class="form-group">
            <a href="{{route('admin.posts.index')}}" role="button" class="btn btn-success">Go back</a>
            {!! Form::submit('Delete permamently', ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    @endwrapper
@endsection