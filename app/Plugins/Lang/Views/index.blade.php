@extends('admin.layouts.full-width')

@section('breadcrumbs')
    <ul>
        <x-crumb route="admin.dashboard.index" name="admin/routes.admin" />
        <x-crumb route="admin.plugins.index" name="admin/routes.modules" />
        <x-crumb route="Lang::index" name="Lang" />
        <x-crumb name="admin/routes.list" />
    </ul>
@endsection

@section('module-content')
    <x-wrapper title="Manage custom languages">

        {{-- Display table --}}
        <x-table :table="$table" :fields="$langs" />

        {{-- Create button --}}
        <x-create-button route="Lang::create" access="MODULE_USE" />

    </x-wrapper>
@endsection
