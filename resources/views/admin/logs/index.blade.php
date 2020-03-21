@extends('layouts.admin.containers.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.settings') }}</a></li>
        <li><a href="{{route('admin.settings.logs.index')}}">{{ __('admin/routes.logs') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Action logs'])    
        <p>Click on selected action log to see more details.</p>
        <div id="logs-table">
            <div class="form-group row">
                <div class="col-4 pr-0">
                    <input type="text" placeholder="Search..." name="search" class="form-control">
                </div>

                <div class="col-3 pr-0">
                    <select id="log-type" class="form-control">
                        <option value="0">All action types</option>
                        <option value="PAGE">Pages</option>
                        <option value="POST">Posts</option>
                        <option value="POST_CATEGORY">Post categories</option>
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
    @endwrapper
@endsection