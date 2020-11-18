<div id="slider-{{ $key }}" class="slider slider--hero">
    <div class="glide__track slider__track" data-glide-el="track">
        <div class="glide__slides slider__slides">
            @foreach($block['slider']->files as $slide)
                <div class="slider__slide glide__slide">

                    {{-- Image --}}
                    <img class="slider__image" src="/images/{{$slide->path}}">

                    {{-- Content --}}
                    <div class="container">
                        <div class="slider__content">
                            <h1 class="slider__title">{{ $slide->pivot->title ?? null}}</h1>
                            <p class="slider__slogan">{{ $slide->pivot->description ?? null }}</p>

                            @if ($slide->pivot->url)
                                <a class="btn cta" href="{{ $slide->pivot->url }}">{{ __('Theme::general.more') }}</a>
                            @endif
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>



    {{-- Display controls --}}
    @if($block['controls'] == 1)
        <div class="glide__bullets slider__controls" data-glide-el="controls[nav]">
            @foreach($block['slider']->files as $key => $slide)
                <button class="glide__bullet slider__bullet" data-glide-dir="={{ $key }}"></button>
            @endforeach
        </div>
    @endif
</div>
