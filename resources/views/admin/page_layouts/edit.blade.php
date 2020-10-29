@extends('admin.layouts.columns-8-4')


@push('head')
    <script src="{{asset('assets/js/gridstack.all.js')}}"></script>
    <script src="{{asset('assets/js/Chart.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/layouts.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/gridstack.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slick-theme.css')}}">
@endpush


@push('scripts-bottom')
    <script src="{{asset('js/admin/layouts.js')}}" defer></script>
    <script src="{{asset('assets/js/slick.min.js')}}" defer></script>
    @include('admin.page_layouts.partials.scripts')
@endpush


@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{ route('admin.pages.index') }}">{{ __('admin/routes.pages') }}</a></li>
        <li><a href="{{ route('admin.pages.layouts.index') }}">{{ __('admin/routes.layouts') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')
    <div id="fade"></div>
    @include('admin.page_layouts.partials.controls')
    {!! Form::model($layout, ['method' => 'PATCH', 'action' => ['Admin\Modules\LayoutsController@update', $layout->id], 'class' => 'w-100', 'id' => 'LayoutUpdateForm']) !!}
@endsection


@section('content-left')
    @include('admin.partials.validation')

    <div id="layout" class="grid-stack">
        @if (!empty($layout->blocks) && count($layout->blocks) > 0)
            @foreach($layout->blocks as $block)
                @widget('Blocks.'.$block['type'], [
                    'x' => $block->x,
                    'y' => $block->y,
                    'w' => $block->width,
                    'h' => $block->height,
                    'block_id' => $block->id,
                    'is_admin' => true,
                    'exists' => true,
                    'block' => $block,
                ])
            @endforeach
        @else
        @include('admin.blocks.module', ['config' => [
            'x' => 0,
            'y' => 0,
            'w' => 6,
            'h' => 1,
            'block_id' => 0
        ]])
        @endif
    </div>
@endsection


@section('content-right')
    <x-wrapper title="admin/layouts.index_title">

        {{-- Display form --}}
        <x-form-fields :fields="$form['basic_data']" />

        {{-- Save button --}}
        <x-update-button />

        {{-- Close the form --}}
        {!! Form::close() !!}

    </x-wrapper>
@endsection
