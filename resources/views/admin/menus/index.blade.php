@extends('admin.templates.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.blocks.index')}}">{{ __('admin/routes.blocks') }}</a></li>
        <li><a href="{{route('admin.blocks.menus.index')}}">{{ __('admin/routes.menus') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    <x-wrapper title="admin/blocks/menus.menu_index_title">

        {{-- Table --}}
        <x-table :table="$table" :fields="$menus" />

        {{-- Create button  --}}
        <x-create-button access="BLOCK_CREATE" route="admin.blocks.menus.create" />

        {{-- Pagination --}}
        <div class="float-right">{{ $menus->render() }}</div>

        {{-- Delete modal --}}
        <x-admin.modals.delete id="delete-menu-modal" title="admin/media.delete_title" message="admin/media.delete_information" />

    </x-wrapper>
@endsection
