@extends('admin.layouts.full-width')

@section('breadcrumbs')
    <ul>
        <x-crumb route="admin.dashboard.index" name="admin/routes.admin" />
        <x-crumb route="admin.plugins.index" name="admin/routes.modules" />
        <x-crumb route="Lang::index" name="Lang" />
        <x-crumb name="admin/routes.create" />
    </ul>
@endsection

@section('module-content')
    <x-wrapper title="Fill lang data">
        {!! Form::open(['method' => 'POST', 'route' => 'Lang::store', 'class' => 'w-100', 'files' => 'true']) !!}

            {{-- Validation report --}}
            <x-form-validation :errors="$errors" />

            {{-- Display form --}}
            <x-form-fields :fields="$form" />

            {{-- Save button --}}
            <x-update-button />

        {!! Form::close() !!}
    </x-wrapper>
@endsection
