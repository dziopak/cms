@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.pages') }}</a></li>
        <li><a href="{{route('admin.pages.categories.index')}}">{{ __('admin/routes.categories') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')
    {!! Form::model($category, ['method' => 'PATCH', 'route' => ['admin.plugins.portfolio.categories.update', $category->id], 'class' => 'w-100']) !!}
    @include('admin.partials.validation')
@endsection


@section('module-content')
    @wrapper('admin.partials.wrapper', ['title' => 'admin/page_categories.edit_left_title'])

        @include('partials.form-fields', ['fields' => $form['basic_data']])

        <div class="form-group">
            {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
        </div>

    @endwrapper
@endsection


@section('after')
    {!! Form::close() !!}
@endsection
