@foreach($layout->blocks as $block)
    {{-- @dump($block) --}}

    @wrapper('themes.default.blocks.wrapper')
        @if ($block->type === 'module')
        <div class="module">
            @yield('content')
        </div>
        @else
            @widget('front.'.$block['type'], ['block' => $block, 'position' => $block->pivot, 'key' => randomString() ])
        @endif
    @endwrapper
@endforeach
