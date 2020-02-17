@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.pages.index')}}">Pages</a></li>
        <li>List all</li>
    </ul>
@endsection

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <strong>Manage pages</strong>
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
                        @if (count($pages) > 0)
                            @foreach($pages as $page)
                                <tr>
                                    <td>
                                        @if ($page->thumbnail)
                                            <img src="/images/{{$page->thumbnail->path}}" alt="{{ $page->name }}" width="60">
                                        @endif
                                    </td>
                                    <td></td>
                                    <td>{{ $page->name }}</td>
                                    <td>{{ $page->author->name }}</td>
                                    <td>{{ $page->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if (Auth::user()->hasAccess('PAGE_EDIT'))
                                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-success">E</a>
                                        @endif
                                        
                                        @if (Auth::user()->hasAccess('POST_DELETE'))
                                            <a href="{{ route('admin.pages.delete', $page->id) }}" class="btn btn-danger">X</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                @if (Auth::user()->hasAccess('POST_CREATE'))
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-success">Create new</a>
                @endif

                <div class="float-right">{{ $pages->render() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection