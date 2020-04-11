@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.posts.index')}}">{{ __('admin/routes.posts') }}</a></li>
        <li><a href="{{route('admin.posts.categories.index')}}">{{ __('admin/routes.categories') }}</a></li>
        <li>{{ __('admin/routes.list') }}</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/post_categories.index_title'])


        {{-- Table --}}
        @include('admin.partials.table', ['fields' => $categories])
        {{-- End --}}


        {{-- Create button --}}
        @if (Auth::user()->hasAccess('CATEGORY_CREATE'))
            <a href="{{ route('admin.posts.categories.create') }}" class="btn btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </a>
        @endif
        {{-- End --}}


        {{-- Pagination --}}
        <div class="float-right">{{ $categories->render() }}</div>
        {{-- End --}}


    @endwrapper
@endsection
