<div class="carousel__container">
    <p class="carousel__title">{{ $block['carousel']->description }} </p>
    <div id="carousel-{{ $key }}" class="carousel carousel--hero">
        <div class="glide__track carousel__track" data-glide-el="track">
            <div class="glide__slides carousel__slides">
                @foreach($block['carousel']->files as $slide)
                    <div class="carousel__slide glide__slide">

                        {{-- Image --}}
                        <img class="carousel__image" src="/images/{{$slide->path}}">

                    </div>
                @endforeach
            </div>
        </div>

        {{-- Display controls --}}
        @if($block['controls'] == 1)
            <div class="glide__bullets carousel__controls" data-glide-el="controls[nav]">
                @foreach($block['carousel']->files as $key => $slide)
                    <button class="glide__bullet carousel__bullet" data-glide-dir="={{ $key }}"></button>
                @endforeach
            </div>
        @endif
    </div>
</div>
