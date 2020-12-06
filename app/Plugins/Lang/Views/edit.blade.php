@extends('admin.templates.full-width')


@section('breadcrumbs')
    <ul>
        <x-crumb route="admin.dashboard.index" name="admin/routes.admin" />
        <x-crumb route="admin.plugins.index" name="admin/routes.modules" />
        <x-crumb route="Lang::index" name="Lang" />
        <x-crumb name="admin/routes.edit" />
    </ul>
@endsection

@section('module-content')
    <x-wrapper title="Edit lang data">
        {!! Form::model($lang, ['method' => 'PATCH', 'route' => ['Lang::update', $lang->id], 'class' => 'w-100', 'files' => 'true']) !!}


            {{-- Validation report --}}
            <x-form-validation :errors="$errors" />

            {{-- Display form --}}
            <x-form-fields :fields="$form" />

            {{-- Hidden fields --}}
            {!! Form::hidden('lang_id', $lang->id) !!}

            {{-- Save button --}}
            <x-update-button />


        {!! Form::close() !!}
    </x-wrapper>
@endsection
