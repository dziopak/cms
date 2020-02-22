@extends('layouts.admin.containers.full-width')

<?php
    $table_headers = ['Module name' => 'name', 'Description' => 'description'];
    $table_data_types = ['active' => 'boolean'];
    $table_actions = [
        'Control panel' => [
            'url' => 'admin.modules.{module_slug}.index',
            'class' => 'success',
            'access' => 'MODULE_USE',
        ],
        'Settings' => [
            'url' => 'admin.modules.{module_slug}.index',
            'class' => 'primary',
            'access' => 'MODULE_EDIT'
        ],
        'Disable' => [
            'url' => 'admin.modules.{module_slug}.index',
            'class' => 'warning',
            'access' => 'MODULE_EDIT'
        ],
        'Delete' => [
            'url' => 'admin.modules.{module_slug}.index',
            'class' => 'danger',
            'access' => 'MODULE_EDIT'
        ],
    ];
?>

@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.modules.index') }}">Modules</a></li>
        <li>List all</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Active modules'])
        @include('admin.partials.table', ['fields' => $modules['active'], 'mass_edit_by' => 'name'])
    @endwrapper
    
    @wrapper('admin.partials.widget', ['title' => 'Inactive modules'])
        @include('admin.partials.table', ['fields' => $modules['inactive'], 'mass_edit_by' => 'name'])
    @endwrapper
@endsection