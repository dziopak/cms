{{-- Table --}}
<x-table :table="$table" :fields="$files" form_id="media-list-form" :controls="false" :filters="false" :form="false" />

{{-- Create button --}}
<x-create-button access="MEDIA_UPLOAD" route="admin.media.create" />

{{-- Pagination --}}
@if (method_exists($files, 'render'))
    <div class="float-right">{{ $files->render() }}</div>
@endif
