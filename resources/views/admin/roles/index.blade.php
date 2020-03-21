@extends('layouts.admin.containers.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li><a href="{{route('admin.users.roles.index')}}">{{ __('admin/routes.roles') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection

@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Manage user roles'])
        
        @include('admin.partials.searchfilterbar')
        @include('admin.partials.table', ['fields' => $roles])

        @if (Auth::user()->hasAccess('ROLE_CREATE'))
            <a href="{{ route('admin.users.roles.create') }}" class="btn btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </a>
        @endif

        <div class="float-right">{{ $roles->render() }}</div>
    @endwrapper
@endsection