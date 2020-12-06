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

    {!! Form::model($carousel, ['method' => 'PATCH', 'action' => ['Admin\Blocks\CarouselsController@update', $carousel->id], 'class' => 'w-100']) !!}

    <x-wrapper title="admin/blocks/carousels.manage_pictures_title">
        {{-- Carousel's images  --}}
        <div id="carousel-image-data">
            @each('admin.carousels.partials.image_data', $carousel->files, 'image')
        </div>
    </x-wrapper>

@endsection


@section('content-right')
    <x-wrapper title="admin/blocks/carousels.edit_title">

        {{-- Name input --}}
        <div class="form-group">
            {!! Form::label('name', __('admin/blocks/carousels.name')) !!}
            {!! Form::text('name', $carousel->name, ['class' => 'form-control']) !!}
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
    @include('admin.media.modals.add_media', ['endpoint' => route('admin.blocks.carousels.attach', $carousel->id)])
@endsection


@push('scripts-bottom')
    @include('admin.carousels.partials.scripts')
@endpush
