@extends('admin.partials.container', ['layout' => 'full-width'])

<?php
    $table_headers = ['Field name' => 'name', 'Field slug' => 'slug', 'Field type' => 'type', 'Required' => 'required'];
    $table_data_types = ['required' => 'boolean'];
?>

@section('breadcrumbs')
    <ul>
        <li>Admin</li>
        <li>Modules</li>
        <li>User Custom Fields</li>
        <li>List all</li>
    </ul>
@endsection


@section('title')
    Manage user custom fields
@endsection

@section('module-content')
    @include('admin.partials.table')
    </div>
    <a href="{{ route('admin.modules.usercustomfields.create') }}" class="btn btn-success">Create new</a>
@endsection