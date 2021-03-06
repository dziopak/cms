<div id="{{ $modal_id ?? "fade" }}" onclick="$('#fade').fadeOut()" class="row {{ $classes ?? ""}} fade">
    <div id="select-media-modal" class="module-modal">

        {{-- Modal navigation --}}
        <div class="modal-nav">
            <ul>
                <li data-tab="1" class="active">{{ __('admin/media.select_media') }}</li>
                <li data-tab="2">{{ __('admin/media.upload_new') }}</li>
            </ul>
        </div>

        <div class="modal-content">
            <div class="modal-overflow">

                {{-- Media library --}}
                <div class="modal-tab" data-tab="1">
                    <x-wrapper title="admin/media.edit_title">
                        @include('admin.media.partials.list', ['endpoint' => $endpoint, 'controls' => false])
                    </x-wrapper>
                </div>


                {{-- Upload media --}}
                <div class="modal-tab" data-tab="2" style="display: none;">
                    <x-wrapper title="admin/media.edit_title">
                        <div style="height: 100%;">
                            @include('admin.media.partials.upload', ['modal_id' => $modal_id ?? ""])
                        </div>
                    </x-wrapper>
                </div>
            </div>


            {{-- Add media to slider --}}
            <div id="{{ !empty($modal_id) ? $modal_id.'_' : '' }}slider-add-existing" style="width: 100px;" class="btn btn-success mx-auto mt-4">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </div>
        </div>

    </div>
</div>

@push('scripts-bottom')
    @if (!empty($single) && $single === true)
        <script>
            $(document).ready(function() {
                @if (!empty($modal_id))
                    $("#{{ $modal_id }} .data-list-table input[name^='mass_edit']").each(function() {
                        $(this).attr('type', 'radio');
                        $(this).attr('name', 'thumbnail');
                    });
                    $('#{{ $modal_id }} .select-all').hide();
                @else
                    $("#fade .data-list-table input[name^='mass_edit']").each(function() {
                        $(this).attr('type', 'radio');
                        $(this).attr('name', 'thumbnail');
                    });
                    $('#select-media-modal .select-all').hide();
                @endif
            });
        </script>
    @endif
@endpush
