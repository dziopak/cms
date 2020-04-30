{{-- Table --}}
@include('admin.partials.table', ['fields' => $files, 'form_id' => 'media-list-form'])
{{-- End --}}


{{-- Create button --}}
@if (Auth::user()->hasAccess('MEDIA_UPLOAD') && (!isset($controls) || $controls === true))
    <a href="{{ route('admin.media.create') }}" class="btn btn-success">
        <i class="fa fa-plus" aria-hidden="true"></i>
        {{ __('admin/general.create_button') }}
    </a>
@endif
{{-- End --}}


{{-- Pagination --}}
@if (method_exists($files, 'render'))
    <div class="float-right">{{ $files->render() }}</div>
@endif
{{-- End --}}
