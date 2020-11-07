@extends('admin.layouts.columns-4-8')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.blocks.index')}}">{{ __('admin/routes.blocks') }}</a></li>
        <li><a href="{{route('admin.blocks.menus.index')}}">{{ __('admin/routes.menus') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@push('head')
    <link href="{{asset('/css/menus.css')}}" rel="stylesheet">
    <script src="{{asset('/assets/js/nestable.js')}}"></script>
@endpush


@push('scripts-bottom')
    <script src="{{asset('/js/admin/menus.js')}}"></script>
@endpush


@section('content-left')

    <x-wrapper title="admin/blocks/menus.menu_data_title">
        {!! Form::model($menu, ['method' => 'PATCH', 'action' => ['Admin\Blocks\MenusController@update', $menu->id], 'class' => 'w-100']) !!}

            {{-- Name input --}}
            <div class="form-group">
                {!! Form::label('name', __('admin/blocks/menus.name').':') !!}
                {!! Form::text('name', $menu->name, ['class' => 'form-control']) !!}
            </div>

            {{-- Save button --}}
            <x-update-button />

        {!! Form::close() !!}
    </x-wrapper>


    <x-wrapper title="Item type">
        {{-- Type Checkbox --}}
        <div class="form-group">

            {!! Form::label('type', 'Entry type:') !!}
            {!! Form::select('type', $entities, '0', ['class' => 'form-control', 'id' => 'entry-type']) !!}

        </div>
    </x-wrapper>


    <x-wrapper title="admin/blocks/menus.menu_add_field_title">

        {{-- Label --}}
        <div class="form-group">
            {!! Form::label('item_label', __('admin/blocks/menus.item_label').':') !!}
            {!! Form::text('item_label', null, ['class' => 'form-control']) !!}
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


        {{-- MODEL DATA --}}
        {!! Form::hidden('item_model_id', null, ['id' => 'item_model_id']) !!}
        {!! Form::hidden('item_model_type', null, ['id' => 'item_model_type']) !!}



        {{-- Search & Results --}}
        @include('admin.blocks.menus.partials.item-type-model')

        {{-- Add button --}}
        <div id="menu-add-item" class="btn btn-success mt-2" data-action="add" data-add-message="<i class='fa fa-plus' aria-hidden='true'></i> {{ __('admin/general.create_button') }}" data-update-message="{{ __('admin/general.update_button') }}">
            <i class="fa fa-plus" aria-hidden="true"></i>
            {{ __('admin/general.create_button') }}
        </div>

    </x-wrapper>
@endsection


@section('content-right')
    <x-wrapper title="admin/blocks/menus.menu_fields_title">
        @include('admin.blocks.menus.partials.render')
    </x-wrapper>
@endsection


@push('scripts-bottom')
    @include('admin.blocks.menus.partials.scripts')
@endpush
