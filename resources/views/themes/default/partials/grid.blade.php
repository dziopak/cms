@foreach($blocks as $row)
@if ($row['container'] === 1)
    <div class="container">
@endif
    <div class="block-row row">

        @foreach($row as $key => $column)
            @if ($key !== "container")
                <div style="overflow: hidden;" class="block-col col-md-{{ $column['COLUMN_WIDTH'] }}">
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
            @endif
        @endforeach

    </div>
    @if ($row['container'] === 1)
        </div>
    @endif
@endforeach
