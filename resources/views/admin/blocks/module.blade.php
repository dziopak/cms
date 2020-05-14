
@set($key, randomString(15))
<div data-gs-widget="module-block" class="grid-stack-item" data-gs-x="{{ $config['x'] }}" data-gs-y="{{ $config['y'] }}" data-gs-width="{{ $config['w'] }}" data-gs-min-width="6" data-gs-height="{{ $config['h'] }}" data-gs-min-height="1" data-gs-auto-position="true" data-gs-block-id="{{ $config['block_id'] ?? 0 }}" {{ !empty($key) ? "data-gs-key=".$key : "" }}>
    <div class="grid-stack-item-content">
        <div class="widget">
            <div class="card mb-4 w-100 grid-stack-content">
                <i class="fa fas fa-columns widget-container" data-key={{ $key }}></i>

                <div class="card-body">
                    <div class="card-title">
                        <strong>
                            Module
                        </strong>
                    </div>
                </div>

                <input type="hidden" name="config[{{ $key }}][container]" value="{{ $config['block']->container ?? 'false' }}" class="with-container">
            </div>
        </div>
    </div>
</div>
