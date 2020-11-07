@foreach($blocks as $row)

    {{-- Open the container --}}
    @if ($row['container'] === 1)
        <div class="container">
    @endif

        {{-- Loop through rows --}}
        <div class="block-row row">
            @foreach($row as $key => $column)
                @if ($key !== "container")
                    <div style="overflow: hidden;" class="block-row__-col col-md-{{ $column['COLUMN_WIDTH'] }}">


                        {{-- Loop through blocks --}}
                        @foreach($column['BLOCKS'] as $block)

                            {{-- Display block --}}
                            @if ($block->type !== 'module')
                                @set($component, 'admin.blocks.'.$block->type)
                                <x-dynamic-component :component="$component" :block="$block" />

                            {{-- Or module --}}
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
