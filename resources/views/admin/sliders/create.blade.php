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
    {!! Form::open(['method' => 'POST', 'action' => 'Admin\Blocks\SlidersController@store', 'class' => 'w-100']) !!}
        <x-wrapper title="admin/blocks/sliders.create_title">


            {{-- Name input --}}
            <div class="form-group">
                {!! Form::label('name', __('admin/blocks/sliders.name').':') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            {{-- Save button --}}
            <x-create-button />


        </x-wrapper>
    {!! Form::close() !!}
@endsection
