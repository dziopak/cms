@extends('admin.templates.columns-8-4')

@php
    $fileName = explode("uploads/", $file->path);
    $fileName = $fileName[1];
@endphp


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.media') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')

    {!! Form::model($file, ['method' => 'PATCH', 'action' => ['Admin\Modules\FilesController@update', $file->id], 'class' => 'w-100']) !!}
    <x-form-validation :errors="$errors" />

@endsection


@section('content-left')

    <x-wrapper title="admin/media.edit_title">

        {{-- Display image --}}
        <img class="float-left mr-2" src="/images/{{ $file->path }}" width="160">

        {{-- Display form --}}
        <div class="mb-4">
            <x-form-fields :fields="$form['basic']" />
        </div>

        {{-- Submit button --}}
        <x-update-button />

    </x-wrapper>
@endsection


@section('content-right')

    {{-- Image data --}}
    @include('admin.media.partials.image_data')

    {{-- Related models --}}
    @include('admin.media.partials.related')

@endsection


@section('content-bottom')
    <div class="col-12">
        <x-wrapper title="Edit picture">

            {{-- Display image editor --}}
            <div><img id="image-cropper" src="/images/{{ $file->path }}"></div>

            {{-- Preview button --}}
            <button class="btn btn-primary" id="preview-image">
                <i class="fa fa-home" aria-hidden="true"></i>
                {{ __('admin/media.preview') }}
            </button>

            {{-- Save as new --}}
            <button class="btn btn-success" id="save-as">
                <i class="fa fa-home" aria-hidden="true"></i>
                {{ __('admin/media.save_as') }}
            </button>

            {{-- Override button --}}
            <button class="btn btn-danger" id="save-image">
                <i class="fa fa-home" aria-hidden="true"></i>
                {{ __('admin/media.override') }}
            </button>

        </x-wrapper>
    </div>


    <div id="fade" class="darker">
        <div id="image-preview-modal" class="choice-modal">
            <div class="modal-content">
                <div class="text-center">

                    {{-- Modal content --}}
                    <h3 class="modal-title mb-3">{{ __('admin/media.preview_title') }}</h3>

                    <div id="image-preview-container" class="mb-4">
                        <div id="image-preview-close" class="close" style="margin-top: -40px;">x</div>
                        <img id="image-preview" src="/images/{{ $file->path }}">
                    </div>

                    <div class="modal-nav">
                        <div class="btn btn-primary" id="modal-cancel">{{ __('admin/general.back_button') }}</div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection


@section('after')
    {!! Form::close() !!}
@endsection


@push('head')
    <script src="{{ asset('assets/js/croppie.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/croppie.css') }}">
    <script src="{{ asset('js/admin/media.js') }}" defer></script>
@endpush


@push('scripts-bottom')
    <script>
        var endpoint = '{{ route("admin.media.upload", $file->id) }}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var fname = "{{ $fileName }}";
        var newFileUrl = '{{ route("admin.media.edit", "X") }}';
    </script>
@endpush
