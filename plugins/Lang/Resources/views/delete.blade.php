@extends('admin.layouts.columns-6-6')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.plugins.index')}}">Modules</a></li>
        <li><a href="{{route('admin.plugins.lang.index')}}">Custom langs</a></li>
        <li>Delete</li>
    </ul>
@endsection


@section('content-left')
    @wrapper('admin.partials.wrapper', ['title' => 'Language info'])
        <div style="display: inline-block;">
            {{$lang->name}} [<strong>{{$lang->lang_tag}}</strong>]<br/>
            Created: {{$lang->created_at}}<br/>
        </div>
    @endwrapper

    @wrapper('admin.partials.wrapper', ['title' => 'Remove Language'])

        <p class="alert alert-danger">Are you sure you want to permamently delete this language from system's database? This action is irreversible and all content in {{ $lang->name }} will be removed completely.</p>
        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.plugins.lang.destroy', $lang->id]]) !!}
        <div class="form-group">
            <a href="{{route('admin.plugins.lang.index')}}" role="button" class="btn btn-success">Go back</a>
            {!! Form::submit('Delete permamently', ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}

    @endwrapper
@endsection
