@extends('admin.templates.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.media') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')

    <x-form-validation :errors="$errors" />

@endsection


@section('content-left')

    {!! Form::model($slider, ['method' => 'PATCH', 'action' => ['Admin\Blocks\SlidersController@update', $slider->id], 'class' => 'w-100']) !!}

    <x-wrapper title="admin/blocks/sliders.manage_pictures_title">
        {{-- Slider's images  --}}
        <div id="slider-image-data">
            @each('admin.sliders.partials.image_data', $slider->files, 'image')
        </div>
    </x-wrapper>

@endsection


@section('content-right')
    <x-wrapper title="admin/blocks/sliders.edit_title">

        {{-- Name input --}}
        <div class="form-group">
            {!! Form::label('name', __('admin/blocks/sliders.name')) !!}
            {!! Form::text('name', $slider->name, ['class' => 'form-control']) !!}
        </div>

        {{-- Add media button --}}
        <div onclick="$('#fade').fadeIn()" class="btn btn-success">
            <i class="fa fa-plus" aria-hidden="true"></i>
            {{ __('admin/general.create_button') }}
        </div>

        {{-- Save button --}}
        <x-update-button />

    </x-wrapper>

    {!! Form::close() !!}
@endsection


{{-- Add media modal --}}
@section('content-bottom')
    @include('admin.media.modals.add_media', ['endpoint' => route('admin.sliders.attach', $slider->id)])
@endsection


@push('scripts-bottom')
    @include('admin.sliders.partials.scripts')
@endpush
