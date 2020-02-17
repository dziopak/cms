@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.pages.index')}}">Pages</a></li>
        <li><a href="{{route('admin.pages.categories.index')}}">Categories</a></li>
        <li>List all</li>
    </ul>
@endsection


@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <strong>Manage categories</strong>
                </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 20px;">
                                <input type="checkbox" name="action[all]">
                            </th>
                            <th>Category name</th>
                            
                            @if (Auth::user()->hasAccess('CATEGORY_EDIT') || Auth::user()->hasAccess('CATEGORY_DELETE'))
                                <th style="width: 260px;">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td><input type="checkbox" name="action[{{$category->id}}]"></td>
                                <td>{{$category->name}}</td>
                                <td>
                                    @if (Auth::user()->hasAccess('CATEGORY_EDIT'))
                                        <a class="btn btn-success" href="{{ route('admin.pages.categories.edit', $category->id) }}">Edit</a>                                    
                                    @endif
                                    
                                    @if (Auth::user()->hasAccess('CATEGORY_DELETE'))
                                        <a class="btn btn-danger" href="{{ route('admin.pages.categories.delete', $category->id) }}">Delete</a></td>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (Auth::user()->hasAccess('CATEGORY_CREATE'))
                <a href="{{ route('admin.pages.categories.create') }}" class="btn btn-success">Create new</a>
            @endif

            <div class="float-right">{{ $categories->render() }}</div>
        </div>
    </div>
@endsection