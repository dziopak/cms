<div class="horizontal-menu__toggle"><i class="fas fa fa-bars"></i></div>
<div class="horizontal-menu__mobile-line"></div>

<div class="horizontal-menu horizontal-menu--main grid-item {{ $block['classes'] ?? "" }}">

    {{-- Logo --}}
    <a href="{{ URL::to('/') }}" class="horizontal-menu__logo-link"><img class="horizontal-menu__logo" src="{{ getAsset('img/logo.png') }}" /></a>

    {{-- Mobile menu close button --}}
    <div class="horizontal-menu__close"><i class="far fa fa-times"></i></div>

    {{-- Menu --}}
    @if(!empty($block['menu']))
        <div class="horizontal-menu__container">
            <ul class="horizontal-menu__list {{ $class }}">
                {{-- Menu item's loop --}}
                @foreach($block['menu'][0] as $item)
                    <li class="horizontal-menu__list-item {{ $item['class'] }}">
                        <a class="horizontal-menu__link" href="{{ $item['link'] }}" title="">{{ $item['label'] }}</a>

                        {{-- 2nd level loop --}}
                        <ul class="horizontal-menu__list horizontal-menu__list--sub-menu-1">
                            @if (!empty($block['menu'][$item->id]))
                                @foreach( $block['menu'][$item->id] as $child )
                                    <li class="horizontal-menu__link horizontal-menu__link--sub-menu-1">
                                        <a class="horizontal-menu__link horizontal-menu__link--sub-menu-1" href="{{ $child['link'] }}" title="{{ $item['label'] }}">
                                            {{ $child['label'] }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>

                    </li>
                @endforeach

            </ul>
            <div class="horizontal-menu__underline"></div>
        </div>
    @endif

</div>
