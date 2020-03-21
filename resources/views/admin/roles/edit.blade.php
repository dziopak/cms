@extends('layouts.admin.containers.columns-6-6')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li><a href="{{route('admin.users.roles.index')}}">{{ __('admin/routes.roles') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')
    {!! Form::model($role, ['method' => 'PATCH', 'action' => ['admin\RolesController@update', $role->id]]) !!}
@endsection


@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'Basic role data'])

        @include('admin.partials.validation')
        @include('partials.form-fields', ['fields' => $form['left']])

        <div class="form-group">
            {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
        </div>

    @endwrapper
@endsection

@section('content-right')
    @wrapper('admin.partials.widget', ['title' => 'User access'])

        @include('partials.form-fields', ['fields' => $form['right']])

    @endwrapper
@endsection


@section('after')
    {!! Form::close() !!}
@endsection