@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.users.index')}}">Users</a></li>
        <li>List all</li>
    </ul>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <strong>Manage users</strong>
                </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Active</th>
                        <th>Role</th>
                        <th>Created</th>
                        
                        @if (Auth::user()->hasAccess('USERS_EDIT') || Auth::user()->hasAccess('USERS_DELETE'))
                            <th></th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @if ($users)
                        @foreach($users as $user)
                            <tr>
                                <td><img width="60" src="/images/{{$user->photo->path}}" alt="avatar"></td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->is_active ? "Yes" : "No"}}</td>
                                <td>{{$user->role->name}}</td>
                                <td>{{$user->created_at->diffForHumans()}}</td>
                                
                                @if (Auth::user()->hasAccess('USERS_EDIT') || Auth::user()->hasAccess('USERS_DELETE'))
                                    <td>
                                        @if (Auth::user()->hasAccess('USERS_EDIT'))
                                            <a class="btn btn-success" href="{{route('admin.users.edit', $user->id)}}">E</a>
                                            <a class="btn btn-warning" href="{{route('admin.users.disable', $user->id)}}">B</a>
                                        @endif
                                        @if (Auth::user()->hasAccess('USERS_DELETE'))
                                            <a class="btn btn-danger" href="{{route('admin.users.delete', $user->id)}}">D</a>
                                        @endif
                                    </td>
                                @endif    
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                @if (Auth::user()->hasAccess('USER_CREATE'))
                    <a href="{{ route('admin.users.create') }}" class="btn btn-success">Create new</a>
                @endif

                <div class="float-right">{{ $users->render() }}</div>
            </div>
        </div>
    </div>
@endsection