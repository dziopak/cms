
<div class="vertical-menu grid-item {{ $block['classes'] ?? "" }}">
    @if(!empty($block['menu']))
        <ul>
            <li class="vertical-menu-title">{{ $block['title'] }}</li>
            @foreach($block['menu'] as $menu)
            <li class="">
                <a href="{{ $menu['link'] }}" title="">{{ $menu['label'] }}</a>
                @if( $menu['child'] )

                <ul class="sub-menu">
                    @foreach( $menu['child'] as $child )
                        <li class=""><a href="{{ $child['link'] }}" title="">{{ $child['label'] }}</a></li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
    @endif
</div>
