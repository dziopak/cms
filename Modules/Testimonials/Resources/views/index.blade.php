@extends('layouts.admin.containers.full-width')

@php
    $table_headers = ['' => 'thumbnail', 'Author' => 'author', 'Creation date' => 'created_at'];
    $table_data_types = ['created_at' => 'date', 'thumbnail' => 'image'];
    $table_actions = [
        'Edit' => [
            'url' => 'admin.modules.testimonials.edit',
            'class' => 'success',
            // 'access' => 'CATEGORY_EDIT'
        ],
        'Delete' => [
            'url' => 'admin.modules.testimonials.delete',
            'class' => 'danger',
            // 'access' => 'CATEGORY_DELETE'
        ]
    ];
    $mass_edit = [
        'delete' => 'Delete selected'
    ];
    $sort_by = [
        'author' => 'Author',
        'created_at' => 'Creation date'
    ];
@endphp

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.modules.index')}}">Modules</a></li>
        <li><a href="{{route('admin.modules.testimonials.index')}}">Testimonials</a></li>
        <li>List all</li>
    </ul>
@endsection

@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Manage testimonials'])
        @include('admin.partials.searchfilterbar')
        @include('admin.partials.table', ['fields' => $testimonials])
        @include('admin.partials.massedit')

        @if (Auth::user()->hasAccess('MODULE_USE'))
            <a href="{{ route('admin.modules.testimonials.create') }}" class="btn btn-success">Create new</a>
        @endif
    @endwrapper
@endsection
