@extends('admin.layouts.columns-6-6')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.plugins.index')}}">Modules</a></li>
        <li><a href="{{route('admin.plugins.testimonials.index')}}">Testimonials</a></li>
        <li>Delete</li>
    </ul>
@endsection


@section('content-left')
    @wrapper('admin.partials.wrapper', ['title' => 'Testimonial info'])
        <div style="display: inline-block;">
            Author: {{$testimonial->author}} [<strong>{{$lang->lang_tag}}</strong>]<br/>
            Created: {{$testimonial->created_at}}<br/>
        </div>
    @endwrapper

    @wrapper('admin.partials.wrapper', ['title' => 'Remove testimonial'])

        <p class="alert alert-danger">Are you sure you want to permamently delete this testimonial from system's database? This action is irreversible.</p>
        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.plugins.testimonials.destroy', $testimonial->id]]) !!}
        <div class="form-group">
            <a href="{{route('admin.plugins.testimonials.index')}}" role="button" class="btn btn-success">Go back</a>
            {!! Form::submit('Delete permamently', ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}

    @endwrapper
@endsection
