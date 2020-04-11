@extends('admin.layouts.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.modules.index')}}">Modules</a></li>
        <li><a href="{{route('admin.modules.lang.index')}}">Custom langs</a></li>
        <li>Create</li>
    </ul>
@endsection

@php
    $form = [
        [
            'class' => 'form-group row',
            'items' => [
                'name' => [
                    'type' => 'text',
                    'label' => 'Language name',
                    'required' => true,
                    'value' => null,
                    'class' => ''
                ],
            ],
        ],
        [
            'class' => 'form-group row',
            'items' => [
                'origin_name' => [
                    'type' => 'text',
                    'label' => 'Origin name',
                    'required' => true,
                    'value' => null,
                    'class' => ''
                ],
            ],
        ],
        [
            'class' => 'form-group row',
            'items' => [
                'lang_tag' => [
                    'type' => 'text',
                    'label' => 'Language tag',
                    'required' => true,
                    'value' => null,
                    'class' => ''
                ],
            ],
        ],
    ];
@endphp

@section('module-content')
    @wrapper('admin.partials.wrapper', ['title' => 'Fill lang data'])
        {!! Form::open(['method' => 'POST', 'route' => 'admin.modules.lang.store', 'class' => 'w-100', 'files' => 'true']) !!}

            @include('admin.partials.validation')
            @include('partials.form-fields', ['fields' => $form])

            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
            </div>

        {!! Form::close() !!}
    @endwrapper
@endsection
