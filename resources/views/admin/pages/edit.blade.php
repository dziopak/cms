@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.pages') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')

    {!! Form::model($page, ['method' => 'PATCH', 'action' => ['Admin\Modules\PagesController@update', $page->id], 'class' => 'w-100', 'files' => 'true']) !!}
    @include('admin.partials.validation')
    @hook('page_edit_before')
    @hook('page_before')

@endsection


@section('content-left')
    <x-wrapper title="admin/pages.edit_left_title">

        @include('partials.form-fields', ['fields' => $form['left']])
        @hook('page_edit_left_content')
        @hook('page_left_content')

    </x-wrapper>
@endsection


@section('content-right')
    <x-wrapper title="admin/pages.edit_right_title">

        @include('partials.form-fields', ['fields' => $form['right']]) e
        @hook('page_edit_right_content')
        @hook('page_right_content')

    </x-wrapper>
@endsection


@section('content-bottom')
    <div class="col">
        <x-wrapper title="admin/pages.edit_bottom_title">

            @include('partials.form-fields', ['fields' => $form['bottom']])

            <!-- Custom field hooks -->
            @hook('page_edit_bottom_content')
            @hook('page_bottom_content')
            <!-- End of field hooks -->


            <div class="form-group">
                {!! Form::hidden('page_id', $page->id) !!}
                {!! Form::button('<i class="fa fa-home"></i>'.' '.__('admin/general.update_button'), ['class' => 'btn btn-success', 'type' => 'submit']) !!}
            </div>

        </x-wrapper>
    </div>
@endsection


@section('after')
    {!! Form::close() !!}
    @include('admin.partials.tinymce')
    @hook('page_edit_after')
    @hook('page_after')
@endsection
