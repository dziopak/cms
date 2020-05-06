<div id="menu-items" class="dd">
    <ol class="dd-list">
        @foreach($menu->items as $item)
            @if ($item->parent === 0)
                <li class="list-group-item dd-item" data-id="{{ $item->id }}" data-link={{ $item->link }} data-label="{{ $item->label }}">
                    <button class="remove">x</button>
                    <div class="dd-handle">{{ $item->label }}</div>


                    @php
                    $subitems = $menu->items()->where(['parent' => $item->id])->get();
                    $count = count($subitems);
                    @endphp

                    @if ($count > 0)
                    <ol class="dd-list">

                        @foreach($subitems as $subitem)
                        @if ($subitem->parent === $item->id)
                        <li class="list-group-item dd-item" data-id="{{ $subitem->id }}" data-link={{ $subitem->link }} data-label="{{ $subitem->label }}">
                            <button class="remove">x</button>
                            <div class="dd-handle">{{ $subitem->label }}</div>
                        </li>
                        @endif
                        @endforeach
                    </ol>
                    @endif
                </li>
            @endif
        @endforeach
    </ol>
</div>
