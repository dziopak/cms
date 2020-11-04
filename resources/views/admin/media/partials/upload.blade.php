@push('scripts')
    <script src="{{asset('vendor/dropzone/dist/min/dropzone.min.js')}}" type="text/javascript"></script>
@endpush


@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/dropzone/dist/min/dropzone.min.css')}}">
    <style>
        .dropzone.dz-clickable .dz-message, .dropzone.dz-clickable .dz-message * {
            margin: 3em 0;
        }
    </style>
@endpush


{{-- Dropzone --}}
@if (!empty($modal_id ?? ''))
    <div id="{{ $modal_id ?? '' }}_dropzone" action="{{ route('admin.media.upload') }}" class="dropzone"></div>
@else
    <div id="dropzone" action="{{ route('admin.media.upload') }}" class="dropzone"></div>
@endif


@push('scripts-bottom')
    <script>
        @if (empty($modal_id ?? ''))
            var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            var selector = "{{ $modal_id ?? '' ? '#'.$modal_id ?? ''.'_dropzone' : '#dropzone' }}";
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone(selector,{
                maxFilesize: 3,  // 3 mb
                acceptedFiles: ".jpeg,.jpg,.png,.pdf",
            }).on("sending", function(file, xhr, formData) {
            formData.append("_token", CSRF_TOKEN);
            });
        @endif
    </script>
@endpush
