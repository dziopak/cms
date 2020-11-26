@extends('admin.layouts.columns-8-4')


@section('breadcrumbs')
    <ul>
        <li><a href="{{route('admin.dashboard.index')}}">{{ __('admin/routes.admin') }}</a></li>
        <li><a href="{{route('admin.pages.index')}}">{{ __('admin/routes.pages') }}</a></li>
        <li>{{ __('admin/routes.edit') }}</li>
    </ul>
@endsection


@section('before')

    {{-- Open the form --}}
    {!! Form::model($page, ['method' => 'PATCH', 'action' => ['Admin\Modules\PagesController@update', $page->id], 'class' => 'w-100', 'files' => 'true']) !!}

    {{-- Validation report --}}
    <x-form-validation :errors="$errors" />

@endsection


@section('content-left')
    <x-wrapper title="admin/pages.edit_left_title">

        {{-- Display form --}}
        <x-form-fields :fields="$form['left']" />

        {{-- Save button --}}
        <x-update-button :container="true" />

    </x-wrapper>
@endsection


@section('content-right')
    <x-wrapper title="admin/pages.edit_right_title">

        {{-- Settings --}}
        <x-form-fields :fields="$form['right']" />

    </x-wrapper>


    {{-- Relations --}}
    <x-wrapper title="admin/pages.edit_right_title">
        <x-form-fields :fields="$form['relations']" />

        <div id="category-list" class="mt-4">
            {!! Form::label('category', 'Przydzielone kategorie: ') !!}<br/>
            @foreach($page->categories as $category)
                <div class="tag" data-id="{{ $category->id }}">
                    <input type="hidden" name="category[]" value="{{ $category->id }}">
                    {{ $category->name }}
                    <span class="close">x</span>
                </div>
            @endforeach
        </div>

        <div id="tag-list" class="mt-4">
            {!! Form::label('tag', 'Przydzielone tagi: ') !!}<br/>
        </div>
    </x-wrapper>


    {{-- SEO --}}
    <x-wrapper title="SEO">
        <x-form-fields :fields="$form['seo']" />
    </x-wrapper>
@endsection


@section('content-bottom')

    {{-- Hidden fields --}}
    {!! Form::hidden('page_id', $page->id) !!}

@endsection


@section('after')

    {{-- Close the form --}}
    {!! Form::close() !!}

    {{-- Include TinyMCE Editor --}}
    @include('admin.partials.tinymce')

@endsection
