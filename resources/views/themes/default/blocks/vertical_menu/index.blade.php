
<div class="vertical-menu grid-item {{ $block['classes'] ?? "" }}">

    @if(!empty($block['menu']))
        <ul>

            {{-- Nav title --}}
            <li class="vertical-menu-title">{{ $block['title'] }}</li>

            {{-- Menu item's loop --}}
            @foreach($block['menu'] as $item)
                <li class="{{ $item['class'] }}">
                    <a href="{{ $item['link'] }}" title="">{{ $item['label'] }}</a>

                    {{-- 2nd level loop --}}
                    @if(isActivePage($item['link']))
                        <ul class="sub-menu">
                            @foreach( $item->items as $child )
                                <li class=""><a href="{{ $child['link'] }}" title="">{{ $child['label'] }}</a></li>
                            @endforeach
                        </ul>
                    @endif

                </li>
            @endforeach

        </ul>
    @endif

</div>
