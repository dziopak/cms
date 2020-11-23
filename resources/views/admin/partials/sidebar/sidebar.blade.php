@php
    $items = getData('Admin/sidebar');
@endphp

<div class="col sidebar">
    <ul class="sidebar-list">

        {{-- Front Office redirect --}}
        <li class="sidebar-list-item">
            <a href="/" style="color: #3490dc;">
                <div class="fa fas fa-backward"></div>
            </a>
        </li>

        {{-- Menu items loop --}}
        @include('admin.partials.sidebar.loop')

        {{-- Lang switcher --}}
        @include('admin.partials.sidebar.lang-switch')

    </ul>

    {{-- Version tag --}}
    <div id="version">
        <strong>D-CMS</strong><br/>
        v1.0.0
    </div>
</div>
