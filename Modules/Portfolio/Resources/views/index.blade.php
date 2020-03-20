@extends('layouts.admin.containers.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="http://cms.test/admin/">Admin</a></li>
        <li><a href="http://cms.test/admin/modules/">Modules</a></li>
        <li><a href="http://cms.test/admin/modules/portfolio/">Portfolio</a></li>
        <li>List items</li>
    </ul>
@endsection

@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'All items'])
        @include('admin.partials.searchfilterbar')
        @include('admin.partials.table', ['fields' => $items])
        @include('admin.partials.massedit')
    @endwrapper
@endsection
