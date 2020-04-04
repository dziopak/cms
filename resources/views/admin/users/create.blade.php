@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.users.index')}}">{{ __('admin/routes.users') }}</a></li>
        <li>{{ __('admin/routes.create') }}</li>
    </ul>
@endsection


@section('before')
    {!! Form::open(['method' => 'POST', 'action' => 'admin\UsersController@store', 'files' => 'true']) !!}
@endsection


@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'admin/users.create_left_title'])

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
    @wrapper('admin.partials.widget', ['title' => 'admin/users.create_right_title'])

        @include('admin.partials.validation')
        @include('partials.form-fields', ['fields' => $form['right']])

    @endwrapper
@endsection


@section('after')
    {!! Form::close() !!}
@endsection
