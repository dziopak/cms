@extends('layouts.admin.containers.full-width')

@section('breadcrumbs')
    <ul>
        <li>Admin</li>
        <li>Appearance</li>
        <li>Menus</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.widget', ['title' => 'Manage menus'])
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        {!! Menu::render() !!}
        {!! Menu::scripts() !!}
    @endwrapper
@endsection