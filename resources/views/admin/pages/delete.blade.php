@extends('admin.layouts.columns-6-6')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.pages') }}</a></li>
        <li>{{ __('admin/routes.delete') }}</li>
    </ul>
@endsection


@section('content-left')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/pages.delete_top_title'])
        <div style="display: inline-block;">
            <strong>{{$page->name}}</strong>
            <p>{{ $page->excerpt }}</p>
            {{ __('admin/general.created_at') }} {{$page->created_at}}
        </div>
    @endwrapper

    @wrapper('admin.partials.wrapper', ['title' => 'admin/pages.delete_bottom_title'])
        <p class="alert alert-danger">{{ __('admin/pages.delete_information') }}</p>

        {!! Form::open(['method' => 'DELETE', 'action' => ['admin\PagesController@destroy', $page->id]]) !!}

        <div class="form-group">
            <a href="{{route('admin.pages.index')}}" role="button" class="btn btn-success">{{ __('admin/general.back_button') }}</a>
            {!! Form::submit(__('admin/general.delete_permamently'), ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    @endwrapper
@endsection
