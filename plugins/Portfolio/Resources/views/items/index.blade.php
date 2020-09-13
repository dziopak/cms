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
    @wrapper('admin.partials.wrapper', ['title' => 'All items'])


        {{-- Table --}}
        @include('admin.partials.table', ['fields' => $items])
        {{-- End --}}


        {{-- Create button --}}
            @if (Auth::user()->hasAccess('MODULE_USE'))
            <a href="{{ route('admin.plugins.portfolio.create') }}" class="btn btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </a>
            @endif
        {{-- End --}}


        {{-- Pagination --}}
        <div class="float-right">{{ $items->render() }}</div>
        {{-- End --}}


    @endwrapper
@endsection
