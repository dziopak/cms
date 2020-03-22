@extends('layouts.admin.containers.full-width')

@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.pages') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'admin/pages.index_title'])    


        {{-- Table --}}
        {{ Form::open(['method' => 'POST', 'route' => 'admin.pages.mass', 'class' => 'w-100']) }}
            @include('admin.partials.table', ['fields' => $pages])
        {{ Form::close() }}
        {{-- End --}}


        {{-- Create button --}}
        @if (Auth::user()->hasAccess('PAGE_CREATE'))
            <a href="{{ route('admin.pages.create') }}" class="btn btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </a>
        @endif
        {{-- End --}}


        {{-- Pagination --}}
        <div class="float-right">{{ $pages->render() }}</div>
        {{-- End --}}

        
    @endwrapper
@endsection