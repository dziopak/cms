@extends('admin.layouts.columns-6-6')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.media.index')}}">{{ __('admin/routes.media') }}</a></li>
        <li>{{ __('admin/routes.delete') }}</li>
    </ul>
@endsection


@section('content-left')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/media.delete_title'])

        {{-- File data --}}
        <div>
            <img class="mr-2 mb-4 float-left" src="/images/{{ $file->path }}" width="120" alt="Image">
            <strong>{{ __('admin/media.name') }}:</strong> {{ $file->name ?? __('admin/media.untitled') }}<br/>
            <strong>{{ __('admin/media.created_at') }}:</strong> {{ $file->created_at }}<br/>
            <strong>{{ __('admin/media.description') }}:</strong> {{ $file->description ?? __('admin/media.no_description') }}
        </div>
        <div class="clearfix"></div>

        {{-- Caution text --}}
        <p class="alert alert-danger">{{ __('admin/media.delete_information') }}</p>


        {!! Form::open(['method' => 'DELETE', 'action' => ['Admin\FilesController@destroy', $file->id]]) !!}

        {{-- Buttons --}}
        <div class="form-group">
            <a href="{{route('admin.media.index')}}" role="button" class="btn btn-success">{{ __('admin/general.back_button') }}</a>
            {!! Form::submit(__('admin/general.delete_permamently'), ['class' => 'btn btn-danger']) !!}
        </div>

        {!! Form::close() !!}

    @endwrapper
@endsection


@section('content-right')

    {{-- Related models --}}
    @include('admin.media.partials.related')

@endsection

