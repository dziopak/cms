@extends('layouts.admin.containers.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'admin/users.list_all'])


        {{-- Displaying data table --}}    
        @include('admin.partials.searchfilterbar') 
        {{ Form::open(['method' => 'POST', 'route' => 'admin.users.mass', 'class' => 'w-100']) }}
            @include('admin.partials.table', ['fields' => $users])
            @include('admin.partials.massedit')
        {{ Form::close() }}
        {{-- End of table --}}


        {{-- Create user button  --}}
        @if (Auth::user()->hasAccess('USER_CREATE'))
            <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </a>
        @endif
        {{-- End --}}


        {{-- Pagination --}}
        <div class="float-right">{{ $users->render() }}</div>
        {{-- End --}}


    @endwrapper
@endsection