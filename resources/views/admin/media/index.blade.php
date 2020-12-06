@extends('admin.templates.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.media.index')}}">{{ __('admin/routes.media') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    {{-- Media list --}}
    <x-wrapper title="admin/media.index_title">
        @include('admin.media.partials.list')
    </x-wrapper>

    {{-- Delete modal --}}
    <x-admin.modals.delete id="delete-media-modal" title="admin/media.delete_title" message="admin/media.delete_information" />
@endsection
