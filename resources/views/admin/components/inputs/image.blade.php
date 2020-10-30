<div class="image-upload-container">
    <img src="/{{ $item['value'] }}" id="{{ $name }}-image-preview" onclick="$('#fade').fadeIn()" class="image-preview {{ $item['class'] }}">
    <button type="button" class="close position-absolute mt-1 mr-4" style="right: 5px;" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>

    @if (!$endpoint)
        {!! Form::hidden($name, null, ['id' => $name]) !!}
    @endif
</div>

@push('content-bottom')
    <x-media-upload-modal :single="true" :form="false" />
@endpush

@push('scripts-bottom')
    @if (!$endpoint)
        <script>
            async function select(file) {
                $('#{{ $name }}').val(file);
                const url = "{{ route('admin.media.show', 0) }}".replace('0', file);
                const response = await axios.get(url);

                if (response.data.path) {
                    $('#{{ $name }}-image-preview').attr('src', '/images/'+response.data.path)
                }
                $('#fade').fadeOut();
            }
        </script>
    @else
        <script>
            async function select(file) {
                try {
                    const response = await axios.put('{{ $endpoint }}', {
                        file,
                        request: 'photo'
                    });

                    if (response.data.path) {
                        $('#{{ $name }}-image-preview').attr('src', '/images/'+response.data.path)
                    }
                    $('#fade').fadeOut();
                } catch (error) {
                    console.error(error);
                }
            }
        </script>
    @endif


    <script>
        $('#slider-add-existing').click(function() {
            var file = $("#select-media-modal input[name^='thumbnail']:checked").val();
            select(file);
        });

        $('.image-upload-container button.close').click(function() {
            select(0);
        });

        $(document).ready(function() {
            myDropzone.on("success", function($response) {
                $($response.previewElement).append('<input class="dropzone-select" type="radio" name="thumbnail" value="'+$response.xhr.response+'" />');
            });
        });
    </script>
@endpush
