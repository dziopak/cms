<div style="
        grid-column-start: {{ $block->pivot->x + 1 }};
        grid-column-end: {{ $block->pivot->x + $block->pivot->width + 1 }};
        grid-row-start: {{ $block->pivot->y + 1 }};
        grid-row-end: {{ $block->pivot->y + $block->pivot->height + 1 }};"
    class="grid-item">
    @child
</div>
