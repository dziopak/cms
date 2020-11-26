<button id="toggle-components">+</button>
<button id="toggle-new-components" class="toggle-components">C</button>
<button id="toggle-existing-components" class="toggle-components">E</button>


<div id="layout-components" class="components-bar">
    <div class="glide__track" data-glide-el="track">
        <div class="glide__slides">

            @foreach(config('blocks') as $key => $block)
                @if (in_array($key, $themeBlocks))
                    <div class="add-widget" data-name="{{ $key }}">
                        <x-new-widget :title="$block['title']">
                            <p>{{ $block['description'] }}</p>
                        </x-new-widget>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
</div>
