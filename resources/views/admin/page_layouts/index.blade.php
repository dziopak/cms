@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{ route('admin.pages.index') }}">{{ __('admin/routes.pages') }}</a></li>
        <li><a href="{{ route('admin.pages.layouts.index') }}">{{ __('admin/routes.layouts') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/layouts.index_title'])


        {{-- Table --}}
        @include('admin.partials.table', ['fields' => $layouts])
        {{-- End --}}


        {{-- Create button --}}
        @if (Auth::user()->hasAccess('LAYOUT_CREATE'))
            <a href="{{ route('admin.pages.layouts.create') }}" class="btn btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </a>
        @endif
        {{-- End --}}


        {{-- Pagination --}}
        <div class="float-right">{{ $layouts->render() }}</div>
        {{-- End --}}


    @endwrapper
@endsection
