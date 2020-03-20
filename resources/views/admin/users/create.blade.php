@extends('layouts.admin.containers.columns-6-6')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.users.index')}}">Users</a></li>
        <li>Create</li>
    </ul>
@endsection

@section('before')
    {!! Form::open(['method' => 'POST', 'action' => 'admin\UsersController@store', 'files' => 'true']) !!}
@endsection

@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'Account data'])

            @include('admin.partials.validation')
            @include('partials.form-fields', ['fields' => $form['left']])

            <div class="form-group">
                {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
            </div>

    @endwrapper
@endsection


@section('content-right')
    @wrapper('admin.partials.widget', ['title' => 'Profile'])

        @include('admin.partials.validation')
        @include('partials.form-fields', ['fields' => $form['right']])

    @endwrapper
@endsection


@section('after')
    {!! Form::close() !!}
@endsection