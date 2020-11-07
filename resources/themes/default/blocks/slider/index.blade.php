@push('scripts-bottom')
@include('Theme::blocks.slider.assets.scripts', [$key = randomString()])
@endpush

<div class="grid-item">
    @switch($block['layout'])
    @case(1)
            @include('Theme::blocks.slider.hero')
        @break

        @case(2)
            @include('Theme::blocks.slider.default')
        @break
    @endswitch
</div>
