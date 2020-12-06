@extends('admin.templates.full-width')

@section('breadcrumbs')
    <ul>
        <x-crumb route="admin.dashboard.index" name="admin/routes.admin" />
        <x-crumb name="admin/routes.search" />
    </ul>
@endsection


@section('module-content')

    <x-wrapper title="admin/search.title">

        {{-- Intro message --}}
        <p>{!! __('admin/search.message', ['count' => $count]) !!}</p>

        {{-- Display results --}}
        <x-table :fields="$result" :table="$table" :controls="false" :filters="false" type="search" />

        {{-- Pagination --}}
        <div class="float-right">{{ $result->render() }}</div>

    </x-wrapper>

@endsection
