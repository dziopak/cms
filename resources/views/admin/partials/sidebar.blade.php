@php
    $items = getData('admin/sidebar');
@endphp

<div class="col sidebar">
    <ul class="sidebar-list">
        <li class="sidebar-list-item">
            <a href="/index.php" style="color: #3490dc;">
                <div class="fa fas fa-backward"></div>
            </a>
        </li>
        @foreach($items as $name => $data)
            <li class="sidebar-list-item">
                <a href="{{ route($data['route']) }}">
                    <div class="{{ $data['class'] }}"></div>
                    {{-- {{ __('admin/menu-items.'.$name) }} --}}
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
        <li class="sidebar-list-item sidebar-lang-switcher">
            <div class="lang-switcher"><img src="/images/langs/{{ \App::getLocale() }}.png" alt="lang"></div>
            <ul class="sidebar-sub-list">
                @foreach(Config::get('app.langs') as $tag => $lang)
                    <li class="sidebar-list-item">
                        <a href="{{ route('locale') }}?lang={{$tag}}">{{ $lang }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
    
    <div id="version">
        <strong>DMS</strong><br/>
        v1.0.0
    </div>
</div>