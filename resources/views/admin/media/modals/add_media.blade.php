<div id="fade" onclick="$('#fade').fadeOut()" class="row">
    <div class="module-modal">

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
                    @wrapper('admin.partials.wrapper', ['title' => 'admin/media.edit_title'])
                        @include('admin.media.partials.list', ['endpoint' => route('admin.blocks.sliders.attach', $slider->id), 'controls' => false])
                    @endwrapper
                </div>


                {{-- Upload media --}}
                <div class="modal-tab" data-tab="2" style="display: none;">
                    @wrapper('admin.partials.wrapper', ['title' => 'admin/media.edit_title'])
                        <div style="height: 100%;">
                            @include('admin.media.partials.upload', ['endpoint' => 'test'])
                        </div>
                    @endwrapper
                </div>


            </div>


            {{-- Add media to slider --}}
            <div id="slider-add-existing" style="width: 100px;" class="btn btn-success mx-auto mt-4">
                <i class="fa fa-plus" aria-hidden="true"></i>
                {{ __('admin/general.create_button') }}
            </div>
        </div>

    </div>
</div>