@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    <x-wrapper title="{{ __('admin/users.list_all') }}">

        {{-- Displaying data table --}}
        <x-table :table="$table" :fields="$users" table_id="users_table"/>

        {{-- Create button  --}}
        <x-create-button access="USER_CREATE" route="admin.users.create" />

        {{-- Pagination --}}
        <div class="float-right">{{ $users->render() }}</div>

    </x-wrapper>


    {{-- Delete modal --}}
    <x-admin.modals.delete id="delete-user-modal" title="admin/users.delete_title" message="admin/users.delete_title" />

@endsection
