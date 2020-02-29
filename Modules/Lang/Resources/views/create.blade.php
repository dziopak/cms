@extends('layouts.admin.containers.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.modules.index')}}">Modules</a></li>
        <li><a href="{{route('admin.modules.lang.index')}}">Custom langs</a></li>
        <li>Create</li>
    </ul>
@endsection

@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Fill lang data'])
        {!! Form::open(['method' => 'POST', 'route' => 'admin.modules.lang.store', 'class' => 'w-100', 'files' => 'true']) !!}
            @include('admin.partials.validation')
            
            <div class="form-group row">
                <div class="col">
                    {!! Form::label('name', 'Language name: ', ['class' => 'required']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col">
                    {!! Form::label('origin_name', 'Original name: ', ['class' => 'required']) !!}
                    {!! Form::text('origin_name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col">
                    {!! Form::label('lang_tag', 'Lang tag: ', ['class' => 'required']) !!}
                    {!! Form::text('lang_tag', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
            </div>

        {!! Form::close() !!}
    @endwrapper
@endsection
