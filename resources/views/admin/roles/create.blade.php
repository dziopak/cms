@extends('admin.layouts.columns-4-8')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li><a href="{{route('admin.users.roles.index')}}">{{ __('admin/routes.roles') }}</a></li>
        <li>{{ __('admin/routes.create') }}</li>
    </ul>
@endsection


@section('before')
    @if (isset($role))
        {!! Form::model($role, ['method' => 'POST', 'action' => 'Admin\Modules\RolesController@store', 'class' => 'w-100']) !!}
    @else
        {!! Form::open(['method' => 'POST', 'action' => 'Admin\Modules\RolesController@store', 'class' => 'w-100']) !!}
    @endif
@endsection


@section('content-left')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/roles.create_left_title'])

        @include('admin.partials.validation')
        @include('partials.form-fields', ['fields' => $form['left']])

        <div class="form-group">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </button>
        </div>

    @endwrapper
@endsection


@section('content-right')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/roles.create_right_title'])

        @include('partials.form-fields', ['fields' => $form['right']])

    @endwrapper
@endsection


@section('after')
    {!! Form::close() !!}
@endsection
