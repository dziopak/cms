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
<div class="dropzone" action="{{route('admin.media.upload')}}">
</div>

@push('scripts-bottom')
<script>

    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone(".dropzone",{
        maxFilesize: 3,  // 3 mb
        acceptedFiles: ".jpeg,.jpg,.png,.pdf",
    }).on("sending", function(file, xhr, formData) {
       formData.append("_token", CSRF_TOKEN);
    });

</script>
@endpush
