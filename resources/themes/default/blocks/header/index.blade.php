<div class="header grid-item">
    <div class="header">
        <div class="header-container">
            <h1>{{ $block['title'] ?? config('global.general.title') }}</h1>
            <p>{{ $block['slogan'] ?? config('global.general.description') }}</p>
            <a class="btn cta" href="#">{{ __('Theme::general.more') }}</a>
        </div>
    </div>
</div>
