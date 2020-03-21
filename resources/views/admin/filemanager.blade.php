@extends('layouts.admin.containers.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">{{ __('admin/routes.admin') }}</a></li>
        <li>{{ __('admin/routes.files') }}</li>
    </ul>
@endsection

@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'File manager'])
        <iframe src="{{ route('unisharp.lfm.show')}}?type=image" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
    @endwrapper
@endsection