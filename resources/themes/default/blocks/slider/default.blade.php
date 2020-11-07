<div id="slider-{{ $key }}" class="slider hero-slider">
    <div class="glide__track" data-glide-el="track">
        <div class="glide__slides">
            @foreach($block['slider']->files as $slide)
                <div class="slide glide__slide">
                    <img src="/images/{{$slide->path}}">
                </div>
            @endforeach
        </div>
    </div>

    {{-- Display arrows --}}
    @if($block['controls'] == 1)
        <div class="glide__arrows" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><</button>
            <button class="glide__arrow glide__arrow--right" data-glide-dir=">">></button>
        </div>
    @endif
</div>
