@extends('layouts.admin.containers.columns-6-6')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.users.index')}}">Users</a></li>
        <li><a href="{{route('admin.users.roles.index')}}">Roles</a></li>
        <li>Create</li>
    </ul>
@endsection

@section('before')
    @if (isset($role))
        {!! Form::model($role, ['method' => 'POST', 'action' => 'admin\RolesController@store', 'class' => 'w-100']) !!}
    @else
        {!! Form::open(['method' => 'POST', 'action' => 'admin\RolesController@store', 'class' => 'w-100']) !!}
    @endif
@endsection

@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'Basic role data'])
        
        @include('admin.partials.validation')
        @include('partials.form-fields', ['fields' => $form['left']])
        
        <div class="form-group">
            {!! Form::submit('Create role', ['class' => 'btn btn-success']) !!}
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