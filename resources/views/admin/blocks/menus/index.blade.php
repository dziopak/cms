@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.blocks.index')}}">{{ __('admin/routes.blocks') }}</a></li>
        <li><a href="{{route('admin.blocks.menus.index')}}">{{ __('admin/routes.menus') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    <x-wrapper title="admin/blocks/menus.menu_index_title">

        {{-- Table --}}
            @include('admin.partials.table', ['fields' => $menus])
        {{-- End --}}


        {{-- Create button --}}
        @if (Auth::user()->hasAccess('BLOCK_CREATE'))
            <a href="{{ route('admin.blocks.menus.create') }}" class="btn btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </a>
        @endif
        {{-- End --}}


        {{-- Pagination --}}
        <div class="float-right">{{ $menus->render() }}</div>
        {{-- End --}}


        {{-- Delete modal --}}
        <div id="fade">
            <div class="choice-modal" id="delete-slider-modal">
                <div class="modal-content">

                    <div class="text-center">
                    {{-- Modal content --}}

                        <h3 class="modal-title mb-3">Delete selected slider</h3>
                        <p class="mb-4">Are you sure you want to permamently remove this slider from the database? This action is irreversible!</p>

                        <div class="modal-nav">
                            <div class="btn btn-danger" data-type="delete" id="modal-confirm">Delete</div>
                            <div class="btn btn-primary" id="modal-cancel">Cancel</div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </x-wrapper>
@endsection
