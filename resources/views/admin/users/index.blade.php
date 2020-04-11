@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/users.list_all'])

        {{-- Displaying data table --}}
        @include('admin.partials.table', ['fields' => $users, 'id' => 'users_table'])
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
