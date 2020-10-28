@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li>{{ __('admin/routes.admin') }}</li>
        <li>{{ __('admin/routes.appearance') }}</li>
        <li>{{ __('admin/routes.menus') }}</li>
    </ul>
@endsection


@section('module-content')
    <x-wrapper title="admin/menus.index_title">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        {!! Menu::render() !!}
        {!! Menu::scripts() !!}
    </x-wrapper>
@endsection
