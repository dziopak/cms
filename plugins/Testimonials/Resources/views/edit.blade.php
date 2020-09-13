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

            <div class="row">
                <div class="col col-3">
                    @include('partials.form-fields', ['fields' => $form['thumbnail']])
                </div>

                <div class="col col-9">
                    @include('partials.form-fields', ['fields' => $form['basic_data']])
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
