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
                            <th></th>
                            <th></th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Created at</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($posts) > 0)
                            @foreach($posts as $post)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $post->name }}</td>
                                    <td>{{ $post->author->name }}</td>
                                    <td>{{ $post->created_at->diffForHumans() }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection