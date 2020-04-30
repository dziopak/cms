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
