@extends('admin.layouts.columns-8-4')


@push('head')
    <script src="{{asset('assets/js/gridstack.all.js')}}"></script>
    <script src="{{asset('assets/js/Chart.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/layouts.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/gridstack.min.css')}}">
@endpush


@push('scripts-bottom')
    <script src="{{asset('js/admin/layouts.js')}}" defer></script>
    <script src="{{asset('assets/js/glide.min.js')}}" defer></script>
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
    <div id="fade" class="layout-edit"></div>
    @include('admin.page_layouts.partials.controls')
    {!! Form::model($layout, ['method' => 'PATCH', 'action' => ['Admin\Modules\LayoutsController@update', $layout->id], 'class' => 'w-100', 'id' => 'LayoutUpdateForm']) !!}
@endsection


@section('content-left')

    {{-- Validation report --}}
    <x-form-validation :errors="$errors" />
    <div id="layout" class="grid-stack">

        {{-- If not empty, display blocks --}}
        @if (empty($layout->blocks) || !count($layout->blocks) >= 0)
            @foreach($layout->blocks as $block)
                @set($component, "admin.blocks.".$block->type)
                <x-dynamic-component :component="$component" :block="$block" :admin="true" :exists="true" />
            @endforeach

        {{-- If empty, bring back the module --}}
        @else
            <x-admin.blocks.module :admin="true" :exists="true" />
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
