@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.blocks.index')}}">{{ __('admin/routes.blocks') }}</a></li>
        <li><a href="{{route('admin.blocks.menus.index')}}">{{ __('admin/routes.menus') }}</a></li>
        <li>{{ __('admin/routes.create') }}</li>
    </ul>
@endsection


@section('before')
    @include('admin.partials.validation')
@endsection


@section('content-left')
    {!! Form::open(['method' => 'POST', 'action' => 'Admin\Blocks\MenusController@store', 'class' => 'w-100']) !!}
    @wrapper('admin.partials.wrapper', ['title' => 'admin/blocks/menus.menu_create_title'])


        {{-- Name input --}}
        <div class="form-group">
            {!! Form::label('name', __('admin/blocks/menus.name').':') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        {{-- Save button --}}
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-home" aria-hidden="true"></i>
            {{ __('admin/general.update_button') }}
        </button>


    @endwrapper
    {!! Form::close() !!}
@endsection
