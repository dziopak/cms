@extends('admin.layouts.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.plugins.index')}}">Modules</a></li>
        <li>Custom langs</li>
        <li>List all</li>
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
