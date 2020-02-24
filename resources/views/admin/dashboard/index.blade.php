@extends('layouts.admin.containers.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">Admin</a></li>
        <li>Dashboard</li>
    </ul>
@endsection

@section('module-content')
    <div id="dashboard">
        @widget('admin.RecentPosts')
        @asyncWidget('admin.RecentLogs')
    </div>
@endsection
