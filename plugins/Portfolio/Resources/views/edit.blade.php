@extends('admin.layouts.columns-8-4')


@push('scripts')
    <script src="{{asset('vendor/dropzone/dist/min/dropzone.min.js')}}" type="text/javascript"></script>
@endpush


@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/dropzone/dist/min/dropzone.min.css')}}">
@endpush


@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.plugins.index')}}">{{ __('admin/routes.modules') }}</a></li>
        <li><a href="{{route('admin.plugins.portfolio.index')}}">{{ __('portfolio::langs.portfolio') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')
    {!! Form::model($item, ['method' => 'PATCH', 'route' => ['admin.plugins.portfolio.update', $item->id], 'id' => 'portfolio-item-form', 'class' => 'w-100', 'files' => 'true']) !!}
    @include('admin.partials.validation')
@endsection


@section('content-left')
    @wrapper('admin.partials.wrapper', ['title' => 'portfolio::langs.basic_data_title'])
        <div class="row">
            <div class="col-lg-3" style="display: flex;">
                <div style="display: block; width: 130px; margin: 0 auto; align-self: center;">
                    @if ($item->file_id && $item->thumbnail)
                        <img src="/images/{{ $item->thumbnail->path }}" width="130" alt="{{ $item->name }}">
                    @endif
                    {{ Form::file('thumbnail', ['style' => 'width: 130px;']) }}
                </div>
            </div>

            {{-- Form fields --}}
            <div class="col-lg-9">
                @include('partials.form-fields', ['fields' => $form['basic_data']])
            </div>
            {{-- End --}}
        </div>
    @endwrapper
@endsection


@section('content-right')
    @wrapper('admin.partials.wrapper', ['title' => 'portfolio::langs.settings_title'])

        <div class="form-group row">
            <div class="col">
                {!! Form::label('thumb_color', 'Thumbnail color: ', ['class' => 'required']) !!}
                <div style="display: flex;">
                    {!! Form::text('thumb_color', null, ['class' => 'form-control color', 'data-color' => 'thumb_color']) !!}
                    {!! Form::color(null, $item->thumb_color, ['class' => 'form-control color', 'data-color' => 'thumb_color']) !!}
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col">
                {!! Form::label('thumb_background', 'Thumbnail background: ', ['class' => 'required']) !!}
                <div style="display: flex;">
                    {!! Form::text('thumb_background', null, ['class' => 'form-control color', 'data-color' => 'thumb_background']) !!}
                    {!! Form::color(null, $item->thumb_background, ['class' => 'form-control color', 'data-color' => 'thumb_background']) !!}
                </div>
            </div>
        </div>

        <!-- Custom field hooks -->
        @hook('module_portfolio_edit_right_content')
        @hook('module_portfolio_right_content')
        <!-- End of field hooks -->

    @endwrapper
@endsection


@section('content-bottom')
    <div class="col">
        @wrapper('admin.partials.wrapper', ['title' => 'portfolio::langs.pictures_title'])
            <div id="pictures">
            </div>

            <div class="dropzone" action="{{route('admin.plugins.portfolio.fileupload')}}">
            </div>

            <div class="py-4">
                @if (count($item->photos) > 0)
                    @foreach($item->photos as $photo)
                        <div class="d-inline-block mr-2 position-relative">
                            <button type="button" class="close position-absolute mt-1" style="right: 5px;" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <img height="100" width="100" src="/{{ $photo->path }}" class="border border-dark" alt="photo">
                        </div>
                    @endforeach
                @else
                    <p class="alert alert-secondary">No photos uploaded</p>
                @endif
            </div>
        @endwrapper

        @wrapper('admin.partials.wrapper', ['title' => 'portfolio::langs.content_title'])


            {{-- Form fields --}}
            <div class="row">
                @include('partials.form-fields', ['fields' => $form['project_content']])
            </div>
            {{-- End --}}

            <!-- Custom field hooks -->
            @hook('module_portfolio_edit_bottom_content')
            @hook('module_portfolio_bottom_content')
            <!-- End of field hooks -->

            {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
        @endwrapper
    </div>
@endsection


@section('after')
    {!! Form::close() !!}
    <script>
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone(".dropzone",{
            maxFilesize: 3,  // 3 mb
            acceptedFiles: ".jpeg,.jpg,.png,.pdf",
        });
        myDropzone.on("sending", function(file, xhr, formData) {
           formData.append("_token", CSRF_TOKEN);
        });
        myDropzone.on("success", function($response) {
           console.log($response.xhr.response);
           if (!isNaN($response.xhr.response)) {
               document.getElementById('pictures').innerHTML += `<input type='hidden' name='pictures[]' value='${$response.xhr.response}'>`;
           }
        });

        document.querySelectorAll('.color').forEach(el => {
            el.onchange = () => {
                color = el.getAttribute('data-color')
                document.querySelectorAll('.color[data-color="'+color+'"]').forEach(target => {
                    target.value = el.value;
                });
            }
        });
    </script>

    <style>
        .dropzone.dz-clickable .dz-message, .dropzone.dz-clickable .dz-message * {
            margin: 3em 0;
        }
    </style>
@endsection