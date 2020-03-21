@extends('layouts.admin.containers.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.posts.index')}}">{{ __('admin/routes.posts') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Manage posts'])
        @include('admin.partials.searchfilterbar')
        {{ Form::open(['method' => 'POST', 'route' => 'admin.posts.mass', 'class' => 'w-100']) }}
            @include('admin.partials.table', ['fields' => $posts])
            @include('admin.partials.massedit')
        {{ Form::close() }}

        @if (Auth::user()->hasAccess('POST_CREATE'))
            <a href="{{ route('admin.posts.create') }}" class="btn btn-success">Create new</a>
        @endif

        <div class="float-right">{{ $posts->render() }}</div>
    @endwrapper
@endsection