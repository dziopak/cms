@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.pages') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')

    <x-wrapper title="admin/pages.index_title">

        {{-- Table --}}
        <x-table :table="$table" :fields="$pages" />

        {{-- Create button  --}}
        <x-create-button access="PAGE_CREATE" route="admin.pages.create" />

        {{-- Pagination --}}
        <div class="float-right">{{ $pages->render() }}</div>

    </x-wrapper>


    {{-- Delete modal --}}
    <x-admin.modals.delete id="delete-page-modal" title="admin/pages.delete_title" message="admin/pages.delete_information" />

@endsection
