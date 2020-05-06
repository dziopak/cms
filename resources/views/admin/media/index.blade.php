@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.media.index')}}">{{ __('admin/routes.media') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/media.index_title'])
        @include('admin.media.partials.list')
    @endwrapper

    {{-- Delete modal --}}
    <div id="fade">
        <div class="choice-modal" id="delete-media-modal">
            <div class="modal-content">

                <div class="text-center">
                {{-- Modal content --}}

                    <h3 class="modal-title mb-3">{{ __('admin/media.delete_title') }}</h3>
                    <p class="mb-4">{{ __('admin/media.delete_information') }}</p>

                    <div class="modal-nav">
                        <div class="btn btn-danger" data-type="delete" id="modal-confirm">{{ __('admin/general.delete_button') }}</div>
                        <div class="btn btn-primary" id="modal-cancel">{{ __('admin/general.back_button') }}</div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
