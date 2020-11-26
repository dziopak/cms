@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.categories.index')}}">{{ __('admin/routes.categories') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')

    <x-wrapper title="admin/categories.index_title">

        {{-- Table --}}
        <x-table :table="$table" :fields="$categories" />

        {{-- Create button  --}}
        <x-create-button access="CATEGORY_CREATE" route="admin.categories.create" />

        {{-- Pagination --}}
        <div class="float-right">{{ $categories->render() }}</div>

    </x-wrapper>


    {{-- Delete modal --}}
    <x-admin.modals.delete id="delete-category-modal" title="admin/categories.delete_title" message="admin/categories.delete_information" />

@endsection
