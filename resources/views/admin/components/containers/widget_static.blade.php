{{-- Load widget's config --}}
<div
    {{ !empty($config['id']) && empty($config['exists']) ? "id=".$config['id'] : '' }}
    class="grid-stack-item"
    data-gs-widget="{{ $config['id'] }}"
    data-gs-x="{{ $config['x'] }}"
    data-gs-y="{{ $config['y'] }}"
    data-gs-width="{{ $config['w'] }}"
    data-gs-height="{{ $config['h'] }}"
    data-gs-min-height="{{ $config['min-h'] }}"
    data-gs-min-width="{{ $config['min-w'] }}"
    data-gs-auto-position="{{ $config['auto'] ?? "true" }}"
    data-gs-no-resize="{{ $config['non-resizeable'] ?? "false" }}"
    data-gs-max-height="{{ $config['max-height'] ?? 10 }}"
    data-gs-block-id="{{ $config['block_id'] ?? 0 }}"
    {{ !empty($key) ? "data-gs-key=".$key : "" }} --}}
>

    {{-- Display widget --}}
    <div class="grid-stack-item-content">
        <div class="widget $classes">
            <div class="widget">
                <div class="card mb-4 w-100 grid-stack-content">
                    <i class="fa fas fa-times widget-remove"></i>
                    <div class="card-body">
                        <div class="card-title">
                            <strong>{{ __($config['header']) }}</strong>
                        </div>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
