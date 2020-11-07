@php
    switch($block['align'] ?? 0) {
        case '0':
        default:
            $class = 'align-left';
        break;

        case '1':
            $class = 'align-right';
        break;

        case '2':
            $class = 'align-center';
        break;
    }
@endphp

<div class="horizontal-menu grid-item {{ $block['classes'] ?? "" }}">

    {{-- Logo --}}
    <a href="{{ URL::to('/') }}"><img class="horizontal-menu__logo" src="{{ getAsset('img/logo.jpg') }}" /></a>

    {{-- Menu --}}
    @if(!empty($block['menu']))
        <div class="horizontal-menu__container">
            <ul class="horizontal-menu__list {{ $class }}">
                {{-- Menu item's loop --}}
                @foreach($block['menu'] as $item)
                    <li class="horizontal-menu__list-item {{ $item['class'] }}">
                        <a class="horizontal-menu__link" href="{{ $item['link'] }}" title="">{{ $item['label'] }}</a>

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
            <div class="horizontal-menu__underline"></div>
        </div>
    @endif

</div>
