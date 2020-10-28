@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.posts.index')}}">{{ __('admin/routes.posts') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    <x-wrapper title="admin/posts.index_title">


        {{-- Table --}}
        @include('admin.partials.table', ['fields' => $posts])
        {{-- End --}}


        {{-- Create button --}}
        @if (Auth::user()->hasAccess('POST_CREATE'))
            <a href="{{ route('admin.posts.create') }}" class="btn btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </a>
        @endif
        {{-- End --}}


        {{-- Pagination --}}
        <div class="float-right">{{ $posts->render() }}</div>
        {{-- End --}}


    </x-wrapper>


    {{-- Delete modal --}}
    <div id="fade">
        <div class="choice-modal" id="delete-post-modal">
            <div class="modal-content">

                <div class="text-center">
                {{-- Modal content --}}

                    <h3 class="modal-title mb-3">{{ __('admin/posts.delete_title') }}</h3>
                    <p class="mb-4">{{ __('admin/posts.delete_information') }}</p>

                    <div class="modal-nav">
                        <div class="btn btn-danger" data-type="delete" id="modal-confirm">{{ __('admin/general.delete_button') }}</div>
                        <div class="btn btn-primary" id="modal-cancel">{{ __('admin/general.back_button') }}</div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
