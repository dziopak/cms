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
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Email</th>
                <th>Active</th>
                <th>Role</th>
                <th>Created</th>
                
                @if (Auth::user()->hasAccess('USERS_EDIT'))
                    <th></th>
                @endif

                @if (Auth::user()->hasAccess('USERS_DELETE'))
                    <th></th>
                @endif
            </tr>
            </thead>
            <tbody>
            @if ($users)
                @foreach($users as $user)
                    <tr>
                        {{-- <td></td> --}}
                        <td><img width="60" src="/images/avatars/{{$user->photo->path}}" alt="avatar"></td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->is_active ? "Yes" : "No"}}</td>
                        <td>{{$user->role->name}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        
                        @if (Auth::user()->hasAccess('USERS_EDIT'))
                            <td>E</td>
                        @endif

                        @if (Auth::user()->hasAccess('USERS_DELETE'))
                            <td>D</td>
                        @endif
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection