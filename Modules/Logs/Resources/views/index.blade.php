@extends('layouts.admin')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.dashboard.index')}}">Settings</a></li>
        <li><a href="{{route('admin.settings.logs.index')}}">Logs</a></li>
        <li>List all</li>
    </ul>
@endsection

@section('content')
    <div class="col" id="logs-table">
        <div class="card">
            <div class="card-body">
                <div class="card-titile">
                    <strong>Action log</strong>
                </div>
                <p>Click on selected action log to see more details.</p>
                <div class="form-group row">
                    <div class="col-4 pr-0">
                        <input type="text" placeholder="Search..." name="search" class="form-control">
                    </div>

                    <div class="col-3 pr-0">
                        <select id="log-type" class="form-control">
                            <option value="0">All action types</option>
                            <option value="PAGE">Pages</option>
                            <option value="POST">Posts</option>
                            <option value="USER">Users</option>
                            <option value="ROLE">Roles</option>
                            <option value="MAIL">Mails</option>
                            <option value="MAIL-LAYOUT">Mail layouts</option>
                        </select>
                    </div>
                    
                    <div class="col-3 pr-0">
                        <select id="log-crud" class="form-control">
                            <option value="0">All actions</option>
                            <option value="1">Create</option>
                            <option value="2">Modify</option>
                            <option value="3">Delete</option>
                        </select>
                    </div>

                    <div class="col-2">
                        <button id="filter-button" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
                @include('admin.partials.logs')
            </div>
        </div>
    </div>
@endsection