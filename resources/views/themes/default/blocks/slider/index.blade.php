@push('scripts-bottom')
    @include('theme', ['view' => 'blocks.slider.assets.scripts', [$key = randomString()]])
@endpush


{{-- To do --}}
{{-- Loading block assets --}}

<style>
    .slider img {
        min-width: 100%;
    }

    .hero-slider .slide-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        text-align: center;
        display: none;
    }

    .hero-slider .slick-current .slide-content {
        display: block;
    }

    .hero-slider .slick-slide {
        height: 100vh;
        position: relative;
    }

    li.slide {
        list-style: none;
    }
</style>


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
