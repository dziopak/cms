{{-- Delete modal --}}
<div id="fade">
    <div class="choice-modal" id="{{ $id }}">
        <div class="modal-content">
            <div class="text-center">

            {{-- Modal content --}}
                <h3 class="modal-title mb-3">{{ __($title) }}</h3>
                <p class="mb-4">{{ __($message) }}</p>

                <div class="modal-nav">
                    <div class="btn btn-danger" data-type="delete" id="modal-confirm">{{ __('admin/general.delete_button') }}</div>
                    <div class="btn btn-primary" id="modal-cancel">{{ __('admin/general.back_button') }}</div>
                </div>

            </div>
        </div>
    </div>
</div>
