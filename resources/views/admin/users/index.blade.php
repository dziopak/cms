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


    {{-- Delete modal --}}
    <div id="fade">
        <div class="choice-modal" id="delete-user-modal">
            <div class="modal-content">

                <div class="text-center">
                {{-- Modal content --}}

                    <h3 class="modal-title mb-3">{{ __('admin/users.delete_title') }}</h3>
                    <p class="mb-4">{{ __('admin/users.delete_information') }}</p>

                    <div class="modal-nav">
                        <div class="btn btn-danger" data-type="delete" id="modal-confirm">{{ __('admin/general.delete_button') }}</div>
                        <div class="btn btn-primary" id="modal-cancel">{{ __('admin/general.back_button') }}</div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
