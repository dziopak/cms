@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.plugins.index')}}">Modules</a></li>
        <li><a href="{{route('admin.plugins.lang.index')}}">Custom langs</a></li>
        <li>Edit</li>
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
    <x-wrapper title="Edit lang data">

        {!! Form::model($lang, ['method' => 'PATCH', 'route' => ['admin.plugins.lang.update', $lang->id], 'class' => 'w-100', 'files' => 'true']) !!}
            @include('admin.partials.validation')
            @include('partials.form-fields', ['fields' => $form])

            <div class="form-group">
                {!! Form::hidden('lang_id', $lang->id) !!}
                {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
            </div>

        {!! Form::close() !!}

    </x-wrapper>
@endsection
