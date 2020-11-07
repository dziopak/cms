<div id="menu-items" class="dd">
    <ol class="dd-list">
        @foreach($menu->items as $item)
            @if ($item->parent === 0)
            <li class="list-group-item dd-item" data-id="{{ $item->id }}" data-label="{{ $item->label }}" data-class="{{ $item->class }}" {{ $item->model_id === 0 && !empty($item->model_type) ? "data-link=".$item->link : "data-relation-id=".$item->model_id." data-relation-type=".$item->model_type }}>
                    <button class="edit btn btn-primary">Edit</button>
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
                                    <li class="list-group-item dd-item" data-id="{{ $subitem->id }}" data-label="{{ $subitem->label }}" data-class="{{ $subitem->class }}" {{ $subitem->model_id === 0 && !empty($subitem->model_type) ? "data-link=".$subitem->link : "data-relation-id=".$subitem->model_id." data-relation-type=".$subitem->model_type }}>
                                        <button class="edit btn">Edit</button>
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
