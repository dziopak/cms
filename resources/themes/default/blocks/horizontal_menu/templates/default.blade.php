<div class="horizontal-menu horizontal-menu--default grid-item {{ $block['classes'] ?? "" }}">
    {{-- Menu --}}
    @if(!empty($block['menu']))
        <div class="horizontal-menu__container">
            <ul class="horizontal-menu__list {{ $class }}">
                {{-- Menu item's loop --}}
                @foreach($block['menu'] as $item)
                    <li class="horizontal-menu__list-item {{ $item['class'] }}">
                        <a class="horizontal-menu__link" href="{{ $item['link'] }}" title="">{{ $item['label'] }}</a>

                        {{-- 2nd level loop --}}
                        <ul class="horizontal-menu__list horizontal-menu__list--sub-menu-1">
                            @foreach( $item->items as $child )
                                <li class="horizontal-menu__link horizontal-menu__link--sub-menu-1">
                                    <a class="horizontal-menu__link horizontal-menu__link--sub-menu-1" href="{{ $child['link'] }}" title="{{ $item['label'] }}">
                                        {{ $child['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </li>
                @endforeach

            </ul>
            <div class="horizontal-menu__underline"></div>
        </div>
    @endif
</div>
