{{-- Table --}}
<x-table formId="media-list-form" :table="$table" :fields="$files" :controls="false" :filters="false" :form="$form ?? true"/>

{{-- Create button --}}
<x-create-button access="MEDIA_UPLOAD" route="admin.media.create" />

{{-- Pagination --}}
@if (method_exists($files, 'render'))
    <div class="float-right">{{ $files->render() }}</div>
@endif
