@push('scripts-bottom')
    @include('theme', ['view' => 'blocks.slider.assets.scripts', [$key = randomString()]])
@endpush

<div class="grid-item">
    @switch($block['layout'])
        @case(1)
            @include('theme', ['view' => 'blocks.slider.hero'])
        @break

        @case(2)
            @include('theme', ['view' => 'blocks.slider.default'])
        @break
    @endswitch
</div>
