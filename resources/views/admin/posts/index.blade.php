@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.posts.index')}}">Posts</a></li>
        <li>List all</li>
    </ul>
@endsection

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <strong>Manage posts</strong>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 70px;"></th>
                            <th></th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Created at</th>
                            <th style="width: 100px;"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($posts) > 0)
                            @foreach($posts as $post)
                                <tr>
                                    <td>
                                        @if ($post->thumbnail)
                                            <img src="/images/{{$post->thumbnail->path}}" alt="{{ $post->name }}" width="60">
                                        @endif
                                    </td>
                                    <td></td>
                                    <td>{{ $post->name }}</td>
                                    <td>{{ $post->author->name }}</td>
                                    <td>{{ $post->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if (Auth::user()->hasAccess('POST_EDIT'))
                                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-success">E</a>
                                        @endif
                                        
                                        @if (Auth::user()->hasAccess('POST_DELETE'))
                                            <a href="{{ route('admin.posts.delete', $post->id) }}" class="btn btn-danger">X</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                @if (Auth::user()->hasAccess('POST_CREATE'))
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-success">Create new</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection