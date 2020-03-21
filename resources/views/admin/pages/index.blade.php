@extends('layouts.admin.containers.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.pages') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Manage pages'])    
        @include('admin.partials.searchfilterbar')    

        {{ Form::open(['method' => 'POST', 'route' => 'admin.pages.mass', 'class' => 'w-100']) }}
            @include('admin.partials.table', ['fields' => $pages])
            @include('admin.partials.massedit')
        {{ Form::close() }}
        
        @if (Auth::user()->hasAccess('PAGE_CREATE'))
            <a href="{{ route('admin.pages.create') }}" class="btn btn-success">Create new</a>
        @endif

        <div class="float-right">{{ $pages->render() }}</div>
    @endwrapper
@endsection