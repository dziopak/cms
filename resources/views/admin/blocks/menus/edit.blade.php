@extends('admin.layouts.columns-4-8')


@push('head')
    <link href="{{asset('/css/menus.css')}}" rel="stylesheet">
    <script src="{{asset('/assets/js/nestable.js')}}"></script>
@endpush


@push('scripts-bottom')
    <script src="{{asset('/js/admin/menus.js')}}"></script>
@endpush


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.blocks.menus.index')}}">{{ __('admin/routes.menus') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('content-left')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/blocks/menus.menu_data_title'])

        {{-- Name input --}}
        <div class="form-group">
            {!! Form::label('name', __('admin/blocks/menus.name'.':')) !!}
            {!! Form::text('name', $menu->name, ['class' => 'form-control']) !!}
        </div>

        {{-- Save button --}}
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-home" aria-hidden="true"></i>
            {{ __('admin/general.update_button') }}
        </button>

    @endwrapper


    <div>
    @wrapper('admin.partials.wrapper', ['title' => 'admin/blocks/menus.menu_add_field_title'])

        {{-- Label --}}
        <div class="form-group">
            {!! Form::label('item_label', __('admin/blocks/menus.item_label').':') !!}
            {!! Form::text('item_label', null, ['class' => 'form-control']) !!}
        </div>

        {{-- Link type --}}
        <div class="form-group">
            {!! Form::label('item_type', __('admin/blocks/menus.item_type').':') !!}
            {!! Form::select('item_type', $item_types, null, ['class' => 'form-control']) !!}
        </div>

        {{-- Extra Classess --}}
        <div class="form-group">
            {!! Form::label('item_class', __('admin/blocks/menus.item_class').':') !!}
            {!! Form::text('item_class', null, ['class' => 'form-control']) !!}
        </div>

        {{-- URL --}}
        <div class="form-group">
            {!! Form::label('item_url', __('admin/blocks/menus.item_url').':') !!}
            {!! Form::text('item_url', null, ['class' => 'form-control']) !!}
        </div>


        <hr/>


        {{-- Search & Results --}}
        @include('admin.blocks.menus.partials.item-type-model')


        {{-- Add button --}}
        <div id="menu-add-item" class="btn btn-success mt-2">
            <i class="fa fa-plus" aria-hidden="true"></i>
            {{ __('admin/general.create_button') }}
        </div>

    @endwrapper
    </div>

@endsection


@section('content-right')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/blocks/menus.menu_fields_title'])
        @include('admin.blocks.menus.partials.render')
    @endwrapper
@endsection


@push('scripts-bottom')
    @include('admin.blocks.menus.partials.scripts')
@endpush
