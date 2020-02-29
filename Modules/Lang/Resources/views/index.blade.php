@extends('layouts.admin.containers.full-width')

@php
    $table_headers = ['Language name' => 'name', 'Origin name' => 'origin_name', 'Lang tag' => 'lang_tag'];
    $table_actions = [
        'Edit' => [
            'url' => 'admin.modules.lang.edit',
            'class' => 'success',
            // 'access' => 'CATEGORY_EDIT'
        ],
        'Delete' => [
            'url' => 'admin.modules.lang.delete',
            'class' => 'danger',
            // 'access' => 'CATEGORY_DELETE'
        ]
    ];
    $mass_edit = [
        'delete' => 'Delete selected'
    ];
    $sort_by = [
        'name' => 'Name',
        'origin_name' => 'Original name',
        'lang_tag' => 'Language tag',
    ];
@endphp

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.modules.index')}}">Modules</a></li>
        <li><a href="{{route('admin.modules.lang.index')}}">Custom langs</a></li>
        <li>List all</li>
    </ul>
@endsection

@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Manage custom languages'])
        @include('admin.partials.searchfilterbar')
        @include('admin.partials.table', ['fields' => $langs])
        @include('admin.partials.massedit')


        <!-- // TO DO // 
        // MODULE ACCESs // -->

        {{-- @if (Auth::user()->hasAccess('CATEGORY_CREATE')) --}}
            <a href="{{ route('admin.modules.lang.create') }}" class="btn btn-success">Create new</a>
        {{-- @endif --}}
    @endwrapper
@endsection
