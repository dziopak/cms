@extends('admin.templates.columns-8-4')


@section('breadcrumbs')
    <ul>
        <x-crumb route="admin.dashboard.index" name="admin/routes.admin" />
        <x-crumb route="admin.dashboard.index" name="admin/routes.blocks" />
        <x-crumb route="admin.blocks.carousels.index" name="admin/routes.carousels" />
        <x-crumb name="admin/routes.edit" />
    </ul>
@endsection


@section('before')
    <x-form-validation :errors="$errors" />
@endsection


@section('content-left')
    {!! Form::open(['method' => 'POST', 'action' => 'Admin\Blocks\CarouselsController@store', 'class' => 'w-100']) !!}
        <x-wrapper title="admin/blocks/carousels.create_title">


            {{-- Name input --}}
            <div class="form-group">
                {!! Form::label('name', __('admin/blocks/carousels.name').':') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            {{-- Description input --}}
            <div class="form-group">
                {!! Form::label('description', __('admin/blocks/carousels.description').':') !!}
                {!! Form::text('description', null, ['class' => 'form-control']) !!}
            </div>

            {{-- Save button --}}
            <x-create-button />


        </x-wrapper>
    {!! Form::close() !!}
@endsection
