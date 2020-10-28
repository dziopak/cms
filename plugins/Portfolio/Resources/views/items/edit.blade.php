@extends('admin.layouts.columns-8-4')


@push('scripts')
    <script>
        const endpoints = {
            attachMedia: '{{ route('admin.plugins.portfolio.attach', $item->id) }}',
            detachMedia: '{{ route('admin.plugins.portfolio.detach', $item->id) }}',
            attachCategory: '{{ route('admin.plugins.portfolio.category.attach', $item->id) }}',
            detachCategory: '{{ route('admin.plugins.portfolio.category.detach', $item->id) }}',
            attachContent: '{{ route('admin.plugins.portfolio.content.attach', $item->id) }}',
            detachContent: '{{ route('admin.plugins.portfolio.content.detach', $item->id) }}',
        };
    </script>
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
    {!! Form::model($item, ['method' => 'PATCH', 'route' => ['admin.plugins.portfolio.update', $item->id], 'id' => 'portfolio-item-form', 'class' => 'w-100', 'files' => 'true']) !!}
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
        </div>
    </x-wrapper>


    <x-wrapper title="portfolio::langs.pictures_title">
        <div id="pictures" class="py-4">
            @if (count($item->photos) > 0)
                @foreach($item->photos as $photo)
                    <div class="d-inline-block mr-2 position-relative picture" data-id="{{ $photo->id }}">
                        <button type="button" class="close position-absolute mt-1" style="right: 5px;" aria-label="Close" data-id="{{ $photo->id }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <img height="100" width="100" src="/images/{{ $photo->path }}" class="border border-dark" alt="photo">
                    </div>
                @endforeach
            @else
                <p class="alert alert-secondary">No photos uploaded</p>
            @endif
        </div>

        {{-- Add media button --}}
        <div id="add-pictures" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i>
            {{ __('admin/general.create_button') }}
        </div>

    </x-wrapper>
@endsection


@section('content-right')
    <x-wrapper title="portfolio::langs.settings_title">

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

        <div class="form-group row">
            <div class="col">
                {!! Form::label('category', 'Add category: ') !!}
                <div style="display: flex;">
                    {!! Form::select('new_category', $categories, null, ['class' => 'form-control mr-3', 'id' => 'new_category']) !!}
                    {!! Form::button('Assign', ['class' => 'btn btn-primary', 'style' => 'width: 140px;', 'id' => 'assign_category']) !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('', 'Assigned categories: ') !!}
            <div id="assigned_categories" class="mt-2">
                @foreach($item->categories as $category)
                    <span data-id="{{ $category->id }}" class="tag mr-1">{{ $category->name }}<small class="close">x</small></span>
                @endforeach
            </div>
        </div>

    </x-wrapper>
@endsection


@section('content-bottom')
    <div class="col">


        <x-wrapper title="portfolio::langs.content_title">

            {{-- Form fields --}}
            <div class="row">
                @include('partials.form-fields', ['fields' => $form['project_content']])
            </div>
            {{-- End --}}


        </x-wrapper>


        @if (!empty($item->content_boxes))
            <x-wrapper title="Additional content">

                <div id="content-boxes">
                    @foreach($item->content_boxes as $box)
                        <div class="portfolio_content_box" data-id="{{ $box->id }}">
                            <small class="close">x</small>
                            <div class="form-group">
                                {!! Form::label('content['.$box->id.'][title]', __('admin/general.title').':') !!}
                                {!! Form::text('content['.$box->id.'][title]', $box->title, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('content['.$box->id.'][content]', __('admin/general.content').':') !!}
                                {!! Form::textarea('content['.$box->id.'][content]', $box->content, ['class' => 'form-control']) !!}
                            </div>

                            <hr/>
                        </div>
                    @endforeach
                </div>

            </x-wrapper>
        @endif

        <x-wrapper title="">
            {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success mb-1', 'type' => 'submit']) !!}
        </x-wrapper>
    </div>

    @include('admin.media.modals.add_media', ['modal_id' => 'portfolio_attach_modal', 'endpoint' => route('admin.plugins.portfolio.attach', $item->id), 'single' => false])
@endsection


@section('after')
    <button id="toggle-components">+</button>
    <button id="add-content-box" class="toggle-components-left toggle-components"></button>
    {!! Form::close() !!}
@endsection
