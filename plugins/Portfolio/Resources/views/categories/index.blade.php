@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.plugins.index') }}">Modules</a></li>
        <li><a href="{{ route('admin.plugins.portfolio.index') }}">Portfolio</a></li>
        <li>List items</li>
    </ul>
@endsection


@section('module-content')
    <x-wrapper title="All items">


        {{-- Table --}}
        <x-table :table="$table" :fields="$categories" />
        {{-- End --}}


        {{-- Create button --}}
            @if (Auth::user()->hasAccess('MODULE_USE'))
            <a href="{{ route('admin.plugins.portfolio.categories.create') }}" class="btn btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </a>
            @endif
        {{-- End --}}


        {{-- Pagination --}}
        <div class="float-right">{{ $categories->render() }}</div>
        {{-- End --}}


    </x-wrapper>
@endsection
