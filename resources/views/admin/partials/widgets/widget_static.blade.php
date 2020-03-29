<div {{ $config['auto'] === true ? "id=".$config['id'] : '' }} class="grid-stack-item" data-gs-widget="{{ $config['id'] }}" data-gs-x="{{ $config['x'] }}" data-gs-y="{{ $config['y'] }}" data-gs-width="{{ $config['w'] }}" data-gs-height="{{ $config['h'] }}" data-gs-min-height="{{ $config['min-h'] }}" data-gs-min-width="{{ $config['min-w'] }}" {{ $config['auto'] === true ? ' data-gs-auto-position=true' : ''}} {{ !empty($config['non-resizeable']) && $config['non-resizeable'] == true ? 'data-gs-no-resize=true' : '' }} data-gs-max-height="{{ !empty($config['max-height']) ? $config['max-height'] : '10' }}">
    <div class="grid-stack-item-content">
        <div class="widget @classes">
            <div class="card mb-4 w-100 grid-stack-content">
                <i class="fa fas fa-times widget-remove"></i>
                <div class="card-body">
                    <div class="card-title">    
                        <strong>
                            @if (!empty($config['icon']))
                                <i class="{{ $config['icon'] }}"></i>
                            @endif

                            {{ __($config['header']) }}
                        </strong>
                    </div>
                    {{-- <div class="scroll-overflow"> --}}
                        @child
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>