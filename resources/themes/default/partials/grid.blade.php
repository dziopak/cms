@foreach($blocks as $row)

    {{-- Open the container --}}
    @if ($row['container'] === 1)
        <div class="container">
    @endif

        {{-- Loop through rows --}}
        <div class="block-row row">
            @foreach($row as $key => $column)
                @if ($key !== "container")
                    <div style="overflow: hidden;" class="block-col col-md-{{ $column['COLUMN_WIDTH'] }}">


                        {{-- Loop through blocks --}}
                        @foreach($column['BLOCKS'] as $block)

                            {{-- Display module or block --}}
                            @if ($block->type !== 'module')
                                @block($block['type'], serialize($block))
                            @else
                                <div class="module">
                                    @yield('module')
                                </div>
                            @endif

                        @endforeach


                    </div>
                @endif
            @endforeach
        </div>

    {{-- Close the container --}}
    @if ($row['container'] === 1)
        </div>
    @endif
@endforeach
