@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.media') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')

    @include('admin.partials.validation')

@endsection


@section('content-left')
    {!! Form::model($slider, ['method' => 'PATCH', 'action' => ['Admin\Blocks\SlidersController@update', $slider->id], 'class' => 'w-100']) !!}

    @wrapper('admin.partials.wrapper', ['title' => 'admin/media.edit_title'])

        {{-- Slider's images  --}}
        @each('admin.blocks.sliders.partials.image_data', $slider->files, 'image')

    @endwrapper
@endsection


@section('content-right')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/media.edit_title'])

        {{-- Name --}}
        <div class="form-group">
            {!! Form::label('name', 'Slider\'s name:') !!}
            {!! Form::text('name', $slider->name, ['class' => 'form-control']) !!}
        </div>

        {{-- Layout --}}
        <div class="form-group">
            {!! Form::label('layout', 'Layout:') !!}
            {!! Form::select('layout', ['0' => 'Hero', '1' => 'Image slider with description'], null, ['class' => 'form-control']) !!}
        </div>

        {{-- Add media button --}}
        <div onclick="$('#fade').fadeIn()" class="btn btn-success">
            <i class="fa fa-plus" aria-hidden="true"></i>
            {{ __('admin/general.create_button') }}
        </div>

        {{-- Add media button --}}
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-home" aria-hidden="true"></i>
            {{ __('admin/general.update_button') }}

    @endwrapper


    {!! Form::close() !!}
@endsection


{{-- Add media modal --}}
@section('content-bottom')
    <div id="fade" onclick="$('#fade').fadeOut()" class="row">
        <div class="module-modal">

            {{-- Modal navigation --}}
            <div class="modal-nav">
                <ul>
                    <li data-tab="1" class="active">Select media</li>
                    <li data-tab="2">Upload new</li>
                </ul>
            </div>

            <div class="modal-content">
                <div class="modal-overflow">

                    {{-- Media library --}}
                    <div class="modal-tab" data-tab="1">
                        @wrapper('admin.partials.wrapper', ['title' => 'admin/media.edit_title'])
                            @include('admin.media.partials.list', ['endpoint' => route('admin.blocks.sliders.attach', $slider->id), 'controls' => false])
                        @endwrapper
                    </div>


                    {{-- Upload media --}}
                    <div class="modal-tab" data-tab="2" style="display: none;">
                        @wrapper('admin.partials.wrapper', ['title' => 'admin/media.edit_title'])
                            <div style="height: 100%;">
                                @include('admin.media.partials.upload', ['endpoint' => 'test'])
                            </div>
                        @endwrapper
                    </div>


                </div>


                {{-- Add media to slider --}}
                <div id="slider-add-existing" style="width: 100px;" class="btn btn-success mx-auto mt-4">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    {{ __('admin/general.create_button') }}
                </div>
            </div>

        </div>
    </div>
@endsection


@push('scripts-bottom')
    @include('admin.blocks.sliders.partials.scripts')
@endpush
