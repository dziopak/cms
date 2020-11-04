@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{ route('admin.pages.index') }}">{{ __('admin/routes.pages') }}</a></li>
        <li><a href="{{ route('admin.pages.layouts.index') }}">{{ __('admin/routes.layouts') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    <x-wrapper title="admin/layouts.index_title">


        {{-- Table --}}
        <x-table :table="$table" :fields="$layouts" />

        {{-- Create button  --}}
        <x-create-button access="LAYOUT_CREATE" route="admin.pages.layouts.create" />

        {{-- Pagination --}}
        <div class="float-right">{{ $layouts->render() }}</div>

        {{-- Delete modal --}}
        <x-admin.modals.delete id="delete-layout-modal" title="admin/pages.delete_title" message="admin/pages.delete_information" />
    </x-wrapper>
@endsection
