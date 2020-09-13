@foreach($items as $name => $data)
    <li class="sidebar-list-item">
        <a href="{{ route($data['route']) }}">
            <div class="{{ $data['class'] }}"></div>
        </a>

        @if (!empty($data['items']))
            <ul class="sidebar-sub-list">
                @foreach($data['items'] as $item_name => $item_data)
                    <li class="sidebar-list-item">
                        <a href="{{ route($item_data['route']) }}">
                            @if(!empty($item_data['custom_label']))
                                {{ __($item_data['custom_label']) }}
                            @else
                                {{ __('admin/menu-items.'.$name.'_items.'.$item_name) }}
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </li>
@endforeach
