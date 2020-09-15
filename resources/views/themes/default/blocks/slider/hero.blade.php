<div id="{{ $key }}" class="slider hero-slider" style="height: 100vh;">
    @foreach($block['slider']->files as $slide)
        <li class="slide">
            <img src="/images/{{$slide->path}}">
                <div class="slide-content">
                <h1>{{ $slide->pivot->title ?? null}}</h1>
                <p>{{ $slide->pivot->description ?? null }}</p>

                @if ($slide->pivot->url)
                <a class="btn cta" href="{{ $slide->pivot->url }}">Read more</a>
                @endif
            </div>
        </li>
    @endforeach
</div>
