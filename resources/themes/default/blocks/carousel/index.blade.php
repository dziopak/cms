@push('scripts-bottom')
    @include('Theme::blocks.carousel.assets.scripts', [$key = randomString()])
@endpush

<div class="grid-item">
    @include('Theme::blocks.carousel.default')
</div>
