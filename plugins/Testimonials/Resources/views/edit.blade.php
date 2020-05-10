@extends('admin.layouts.full-width')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">Admin</a></li>
        <li><a href="{{route('admin.plugins.index')}}">Modules</a></li>
        <li><a href="{{route('admin.plugins.testimonials.index')}}">Testimonials</a></li>
        <li>Edit</li>
    </ul>
@endsection


@section('module-content')
    @wrapper('admin.partials.wrapper', ['title' => 'Update testimonial data'])
        {!! Form::model($testimonial, ['method' => 'PATCH', 'route' => ['admin.plugins.testimonials.update', $testimonial->id], 'class' => 'w-100', 'files' => 'true']) !!}
            @include('admin.partials.validation')

            <div class="form-group row">
                <div class="col">
                    {!! Form::label('thumbnail', 'Thumbnail: ') !!}
                    {!! Form::file('thumbnail', ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col">
                    {!! Form::label('author', 'Author: ', ['class' => 'required']) !!}
                    {!! Form::text('author', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col">
                    {!! Form::label('author_title', 'Author\'s title: ', ['class' => 'required']) !!}
                    {!! Form::text('author_title', null, ['class' => 'form-control']) !!}
                </div>
            </div>


            <div class="form-group row">
                <div class="col">
                    {!! Form::label('content', 'Content: ', ['class' => 'required']) !!}
                    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <!-- Custom field hooks -->
            @hook('modules_testimonials_edit')
            @hook('modules_testimonials')
            <!-- End of field hooks -->

            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
            </div>

        {!! Form::close() !!}
    @endwrapper
@endsection