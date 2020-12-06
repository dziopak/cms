@extends('admin.templates.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li><a href="{{route('admin.users.roles.index')}}">{{ __('admin/routes.roles') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')

    <x-wrapper title="admin/roles.index_title">

        {{-- Table --}}
        <x-table :table="$table" :fields="$roles" />

        {{-- Create button  --}}
        <x-create-button access="ROLE_CREATE" route="admin.users.roles.create" />

        {{-- Pagination --}}
        <div class="float-right">{{ $roles->render() }}</div>

    </x-wrapper>


    {{-- Delete modal --}}
    <x-admin.modals.delete id="delete-role-modal" title="admin/roles.delete_title" message="admin/roles.delete_information" />

@endsection
