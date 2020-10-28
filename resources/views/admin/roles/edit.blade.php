@extends('admin.layouts.columns-4-8')


{{-- Breadcrumbs --}}
@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li><a href="{{route('admin.users.roles.index')}}">{{ __('admin/routes.roles') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


{{-- Open form --}}
@section('before')
    {!! Form::model($role, ['method' => 'PATCH', 'action' => ['Admin\Modules\RolesController@update', $role->id]]) !!}
@endsection


{{-- Basic data --}}
@section('content-left')
    <x-wrapper title="admin/roles.edit_left_title">

        @include('admin.partials.validation')
        @include('partials.form-fields', ['fields' => $form['left']])

        <div class="form-group">
            {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
        </div>

    </x-wrapper>
@endsection


{{-- Role's access --}}
@section('content-right')
    <x-wrapper title="admin/roles.edit_right_title">
        @include('partials.form-fields', ['fields' => $form['right']])
    </x-wrapper>
@endsection


{{-- Close form --}}
@section('after')
    {!! Form::close() !!}
@endsection
