@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.media.index')}}">{{ __('admin/routes.media') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/blocks/sliders.index_title'])

        {{-- Table --}}
            @include('admin.partials.table', ['fields' => $sliders])
        {{-- End --}}


        {{-- Create button --}}
        @if (Auth::user()->hasAccess('BLOCK_CREATE'))
            <a href="{{ route('admin.blocks.sliders.create') }}" class="btn btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </a>
        @endif
        {{-- End --}}


        {{-- Pagination --}}
        <div class="float-right">{{ $sliders->render() }}</div>
        {{-- End --}}


    @endwrapper
@endsection
