@foreach($blocks as $row)
    <div class="block-row row">
        @foreach($row as $column)
            <div style="border: 1px solid #000; overflow: hidden;" class="block-col col-md-{{ $column['COLUMN_WIDTH'] }}">
                @foreach($column['BLOCKS'] as $block)
                    @if ($block->type === 'module')
                        <div class="module">
                            @yield('module')
                        </div>
                    @else
                        @block($block['type'], serialize($block))
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
@endforeach
