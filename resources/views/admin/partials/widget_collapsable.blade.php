<div {{ $config['auto'] === true ? "id=".$config['id'] : '' }} class="grid-stack-item" data-gs-widget="{{ $config['id'] }}" data-gs-x="{{ $config['x'] }}" data-gs-y="{{ $config['y'] }}" data-gs-width="{{ $config['w'] }}" data-gs-height="{{ $config['h'] }}" data-gs-min-height="{{ $config['min-h'] }}" data-gs-min-width="{{ $config['min-w'] }}" {{ $config['auto'] === true ? ' data-gs-auto-position=true' : ''}}>
    <div class="grid-stack-item-content">
        <div class="widget @classes">
            <div class="card mb-4 w-100 grid-stack-content">
                <div class="card-body">
                    <div class="card-title">    
                        <strong>
                            @title
                        </strong>
                    </div>
                @child
                </div>
            </div>
        </div>
    </div>
</div>