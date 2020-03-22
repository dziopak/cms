@php
    $items = getData('admin/sidebar');
@endphp

<div class="col-3 col-sm-3 col-md-2 col-lg-1 sidebar">
    <ul class="sidebar-list">
        @foreach($items as $name => $data)
            <li class="sidebar-list-item">
                <a href="{{ route($data['route']) }}">
                    <div class="{{ $data['class'] }}"></div>
                    {{ __('admin/menu-items.'.$name) }}
                </a>

                @if (!empty($data['items']))
                    <ul class="sidebar-sub-list">
                        @foreach($data['items'] as $item_name => $item_data)
                           <li class="sidebar-list-item">
                                <a href="{{ route($item_data['route']) }}">
                                    @if(!empty($item_data['custom_label']))
                                        {{ $item_data['custom_label'] }}
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
    </ul>
    
    <div id="version">DMS v1.0.0</div>
</div>