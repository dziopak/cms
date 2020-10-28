@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">{{ __('admin/routes.admin') }}</a></li>
        <li>{{ __('admin/routes.files') }}</li>
    </ul>
@endsection


@section('module-content')
    <x-wrapper title="File manager">
        <iframe src="{{ route('unisharp.lfm.show')}}?type=image" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
    </x-wrapper>
@endsection
