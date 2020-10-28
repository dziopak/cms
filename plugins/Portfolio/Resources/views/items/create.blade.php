@extends('admin.layouts.columns-8-4')


@push('scripts')
    @pluginAsset('js', 'admin', 'portfolio')
@endpush


@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/dropzone/dist/min/dropzone.min.css')}}">
@endpush


@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.plugins.index') }}">Modules</a></li>
        <li><a href="{{ route('admin.plugins.portfolio.index') }}">Portfolio</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')
    {!! Form::open(['method' => 'POST', 'route' => 'admin.plugins.portfolio.store', 'id' => 'portfolio-item-form', 'class' => 'w-100', 'files' => 'true']) !!}
    @include('admin.partials.validation')
@endsection


@section('content-left')
    <x-wrapper title="portfolio::langs.basic_data_title">

        <div class="row">
            <div class="col-lg-3" style="display: flex;">
                @include('partials.form-fields', ['fields' => $form['thumbnail']])
            </div>

            {{-- Form fields --}}
            <div class="col-lg-9">
                @include('partials.form-fields', ['fields' => $form['basic_data']])
            </div>
            {{-- End --}}

            <div class="col">
                {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success mx-3 mt-4', 'type' => 'submit']) !!}
            </div>

        </div>

    </x-wrapper>
@endsection


@section('after')
    {!! Form::close() !!}
@endsection
