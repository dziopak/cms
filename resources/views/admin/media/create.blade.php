@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.media') }}</a></li>
        <li>{{ __('admin/routes.create') }}</li>
    </ul>
@endsection


@section('content-left')

    {{-- Files dropzone --}}
    @wrapper('admin.partials.wrapper', ['title' => 'admin/media.upload_files'])
        @include('admin.media.partials.upload')
    @endwrapper

@endsection