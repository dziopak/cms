@extends('admin.layouts.columns-6-6')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.pages') }}</a></li>
        <li><a href="{{route('admin.pages.categories.index')}}">{{ __('admin/routes.categories') }}</a></li>
        <li>{{ __('admin/routes.delete') }}</li>
    </ul>
@endsection


@section('content-left')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/page_categories.delete_top_title'])
        <div style="display: inline-block;">
            {{ __('admin/general.category') }} <strong>{{$category->name}}</strong><br/>
            {{ __('admin/general.created_at') }}: {{$category->created_at}}<br/>
        </div>
    @endwrapper

    @wrapper('admin.partials.wrapper', ['title' => 'admin/page_categories.delete_bottom_title'])
        <p class="alert alert-danger">{{ __('admin/page_categories.delete_information') }}</p>

        {!! Form::open(['method' => 'DELETE', 'action' => ['admin\PageCategoriesController@destroy', $category->id]]) !!}

        <div class="form-group">
            <a href="{{route('admin.pages.categories.index')}}" role="button" class="btn btn-success">{{ __('admin/general.back_button') }}</a>
            {!! Form::submit(__('admin/general.delete_permamently'), ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    @endwrapper
@endsection
