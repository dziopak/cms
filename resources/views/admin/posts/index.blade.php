@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.posts.index')}}">{{ __('admin/routes.posts') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')

    <x-wrapper title="admin/posts.index_title">

        {{-- Table --}}
        <x-table :table="$table" :fields="$posts" />

        {{-- Create button  --}}
        <x-create-button access="POST_CREATE" route="admin.posts.create" />

        {{-- Pagination --}}
        <div class="float-right">{{ $posts->render() }}</div>

    </x-wrapper>


    {{-- Delete modal --}}
    <x-admin.modals.delete id="delete-post-modal" title="admin/posts.delete_title" message="admin/posts.delete_information" />

@endsection
