@extends('admin.layouts.columns-6-6')


@section('breadcrumbs')
    <ul>
        <x-crumb route="admin.dashboard.index" name="admin/routes.admin" />
        <x-crumb route="admin.plugins.index" name="admin/routes.modules" />
        <x-crumb route="Lang::index" name="Lang" />
        <x-crumb name="admin/routes.delete" />
    </ul>
@endsection


@section('content-left')
    <x-wrapper title="Language info">
        <div style="display: inline-block;">
            {{$lang->name}} [<strong>{{$lang->lang_tag}}</strong>]<br/>
            Created: {{$lang->created_at}}<br/>
        </div>
    </x-wrapper>

    <x-wrapper title="Remove Language">

        <p class="alert alert-danger">Are you sure you want to permamently delete this language from system's database? This action is irreversible and all content in {{ $lang->name }} will be removed completely.</p>
        {!! Form::open(['method' => 'DELETE', 'route' => ['Lang::destroy', $lang->id]]) !!}
        <div class="form-group">
            <a href="{{route('Lang::index')}}" role="button" class="btn btn-success">Go back</a>
            {!! Form::submit('Delete permamently', ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}

    </x-wrapper>
@endsection
