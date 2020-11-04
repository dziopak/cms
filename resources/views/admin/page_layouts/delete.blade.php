@extends('admin.layouts.columns-6-6')


@section('breadcrumbs')
    <ul>
        <li><a href="{{ route('admin.dashboard.index') }}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{ route('admin.pages.index') }}">{{ __('admin/routes.pages') }}</a></li>
        <li><a href="{{ route('admin.pages.layouts.index') }}">{{ __('admin/routes.layouts') }}</a></li>
        <li>{{ __('admin/routes.delete') }}</li>
    </ul>
    @endsection


    @section('content-left')
    <x-wrapper title="admin/posts.delete_top_title">


        <p class="alert alert-danger">{{ __('admin/posts.delete_information') }}</p>
        {!! Form::open(['method' => 'DELETE', 'action' => ['Admin\Modules\LayoutsController@destroy', $layout->id]]) !!}
        <div class="form-group">
            <a href="{{route('admin.posts.index')}}" role="button" class="btn btn-success">{{ __('admin/general.back_button') }}</a>
            {!! Form::submit(__('admin/general.delete_permamently'), ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}


    </x-wrapper>
@endsection
