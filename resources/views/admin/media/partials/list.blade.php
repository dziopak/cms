{{-- Table --}}
<x-table formId="media-list-form" :table="$table" :fields="$files" :controls="false" :filters="false" :mass="true" :form="$form ?? true"/>


{{-- Create button --}}
@if (empty($controls) || $controls === true)
    <x-create-button access="MEDIA_UPLOAD" route="admin.media.create" />
@endif


{{-- Pagination --}}
@if (method_exists($files, 'render'))
    <div class="float-right">{{ $files->render() }}</div>
@endif
