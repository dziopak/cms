@extends('admin.layouts.columns-6-6')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.posts.index')}}">{{ __('admin/routes.posts') }}</a></li>
        <li>{{ __('admin/routes.delete') }}</li>
    </ul>
@endsection


@section('content-left')
    @wrapper('admin.partials.widget', ['title' => 'admin/posts.delete_top_title'])
        <div style="display: inline-block;">
            <strong>{{$post->name}}</strong>
            <p class="mt-2">{{ $post->excerpt }}</p>
            {{ __('admin/general.created_at') }} {{$post->created_at}}
        </div>
    @endwrapper

    @wrapper('admin.partials.widget', ['title' => 'admin/posts.delete_top_title'])
        <p class="alert alert-danger">{{ __('admin/posts.delete_information') }}</p>

        {!! Form::open(['method' => 'DELETE', 'action' => ['admin\PostsController@destroy', $post->id]]) !!}

        <div class="form-group">
            <a href="{{route('admin.posts.index')}}" role="button" class="btn btn-success">{{ __('admin/general.back_button') }}</a>
            {!! Form::submit(__('admin/general.delete_permamently'), ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    @endwrapper
@endsection
