@extends('layouts.admin.containers.columns-8-4')

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
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.modules.index')}}">Modules</a></li>
        <li><a href="{{route('admin.modules.portfolio.index')}}">Modules</a></li>
        <li>Create</li>
    </ul>
@endsection

@section('before')
    {!! Form::open(['method' => 'POST', 'route' => 'admin.modules.portfolio.store', 'id' => 'portfolio-item-form', 'class' => 'w-100', 'files' => 'true']) !!}
    @include('admin.partials.validation')
@endsection


@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'Basic project data'])
        <div class="row">
            <div class="col-lg-3" style="display: flex;">
                <div style="display: block; width: 130px; margin: 0 auto; align-self: center;">
                    {{ Form::file('thumbnail', ['style' => 'width: 130px;']) }}
                </div>
            </div>

            <div class="col-lg-9">
                <div class="form-group row">
                    <div class="col">
                        {!! Form::label('name', 'Name: ', ['class' => 'required']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
    
                <div class="form-group row">
                    <div class="col">
                        {!! Form::label('slug', 'Slug: ', ['class' => 'required']) !!}
                        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        
    @endwrapper
@endsection

@section('content-right')
    @wrapper('admin.partials.widget', ['title' => 'Project settings'])
        
        <div class="form-group row">
            <div class="col">
                {!! Form::label('thumb_color', 'Thumbnail color: ', ['class' => 'required']) !!}
                <div style="display: flex;">
                    {!! Form::text('thumb_color', '#ffffff', ['class' => 'form-control color', 'data-color' => 'thumb_color']) !!}
                    {!! Form::color(null, '#ffffff', ['class' => 'form-control color', 'data-color' => 'thumb_color']) !!}
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col">
                {!! Form::label('thumb_background', 'Thumbnail background: ', ['class' => 'required']) !!}
                <div style="display: flex;">
                    {!! Form::text('thumb_background', '#ffffff', ['class' => 'form-control color', 'data-color' => 'thumb_background']) !!}
                    {!! Form::color(null, '#ffffff', ['class' => 'form-control color', 'data-color' => 'thumb_background']) !!}
                </div>
            </div>
        </div>
    @endwrapper
@endsection


@section('content-bottom')
    <div class="col">
        @wrapper('admin.partials.widget', ['title' => 'Pictures'])
            <div id="pictures">
            </div>

            <div class="dropzone" action="{{route('admin.modules.portfolio.fileupload')}}">    
            </div>
        @endwrapper

        @wrapper('admin.partials.widget', ['title' => 'Project content'])
        <div class="row">    
            <div class="form-group col-md-6">
                {!! Form::label('intro', 'Intro: ', ['class' => 'required']) !!}
                {!! Form::textarea('intro', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('description', 'Description: ', ['class' => 'required']) !!}
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        {{ Form::submit('Update project', ['class' => 'btn btn-success']) }}
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