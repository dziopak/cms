@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.modules.index')}}">Modules</a></li>
        <li><a href="{{route('admin.modules.usercustomfields.index')}}">User Custom Fields</a></li>
        <li>Create new</li>
    </ul>
@endsection


@section('before')
    {!! Form::open(['method' => 'POST', 'route' => 'admin.modules.usercustomfields.store', 'class' => 'w-100']) !!}
    @include('admin.partials.validation')
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Field data'])
        <div class="form-group row">
            <div class="col">
                {!! Form::label('name', 'Field name: ', ['class' => 'required']) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="col">
                {!! Form::label('slug', 'Slug: ', ['class' => 'required']) !!}
                {!! Form::text('slug', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="col">
                {!! Form::label('required', 'Required: ', ['class' => 'required']) !!}
                {!! Form::select('required', [0 => "No", 1 => "Yes"], null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="col">
                {!! Form::label('type', 'Type: ', ['class' => 'required']) !!}
                {!! Form::select('type', ["text" => "Text", "numeric" => "Number", "check" => "Checkbox"], null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::submit('Create field', ['class' => 'btn btn-success']) !!}
        </div>
    @endwrapper
@endsection


@section('content-right')
    @wrapper('admin.partials.widget', ['title' => 'Manual'])
        <p>Fill all required field information.</p>
    @endwrapper
@endsection


@section('after')
    {!! Form::close() !!}
@endsection

