@foreach($layout->blocks as $block)
    {{-- @dump($block) --}}
<div style="
        grid-column-start: {{ $block->pivot->x + 1 }};
        grid-column-end: {{ $block->pivot->x + $block->pivot->width + 1 }};
        grid-row-start: {{ $block->pivot->y + 1 }};
        grid-row-end: {{ $block->pivot->y + $block->pivot->height + 1 }};"
    class="grid-item">
        @if ($block->type === 'module')
            @yield('content')
        @else
            @widget('front.'.$block['type'])
        @endif
    </div>
@endforeach
