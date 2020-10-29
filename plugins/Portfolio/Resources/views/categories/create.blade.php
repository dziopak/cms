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
    {!! Form::open(['method' => 'POST', 'route' => 'admin.plugins.portfolio.categories.store', 'class' => 'w-100']) !!}
    @include('admin.partials.validation')
@endsection


@section('module-content')
    <x-wrapper title="admin/page_categories.edit_left_title">

        <x-form-fields :fields="$form['basic_data']" />

        <!-- Custom field hooks -->
        @hook('page_category_edit_left_content')
        @hook('page_category_left_content')
        @hook('category_left_content')
        <!-- End of field hooks -->

        <div class="form-group">
            {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
        </div>

    </x-wrapper>
@endsection


@section('after')
    {!! Form::close() !!}
@endsection
