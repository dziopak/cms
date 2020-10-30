@extends('admin.layouts.columns-8-4')


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

@section('after')
    {!! Form::close() !!}
@endsection
