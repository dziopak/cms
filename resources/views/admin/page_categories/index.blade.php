@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.pages') }}</a></li>
        <li><a href="{{route('admin.pages.categories.index')}}">{{ __('admin/routes.categories') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/page_categories.index_title'])


        {{-- Table --}}
        @include('admin.partials.table', ['fields' => $categories])
        {{-- End --}}


        {{-- Create button --}}
        @if (Auth::user()->hasAccess('CATEGORY_CREATE'))
            <a href="{{ route('admin.pages.categories.create') }}" class="btn btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </a>
        @endif
        {{-- End --}}


        {{-- Pagination --}}
        <div class="float-right">{{ $categories->render() }}</div>
        {{-- End --}}


    @endwrapper


    {{-- Delete modal --}}
    <div id="fade">
        <div class="choice-modal" id="delete-category-modal">
            <div class="modal-content">

                <div class="text-center">
                {{-- Modal content --}}

                    <h3 class="modal-title mb-3">{{ __('admin/page_categories.delete_title') }}</h3>
                    <p class="mb-4">{{ __('admin/page_categories.delete_information') }}</p>

                    <div class="modal-nav">
                        <div class="btn btn-danger" data-type="delete" id="modal-confirm">{{ __('admin/general.delete_button') }}</div>
                        <div class="btn btn-primary" id="modal-cancel">{{ __('admin/general.back_button') }}</div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
