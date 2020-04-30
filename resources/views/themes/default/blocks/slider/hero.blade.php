<div id="{{ $key }}" class="slider hero-slider" style="height: 100vh;">
    @foreach($block['slider']->files as $slide)
        <li class="slide">
            <img src="/images/{{$slide->path}}">
                <div class="slide-content">
                <h1>{{ $slide->pivot->title ?? config('global.general.title') }}</h1>
                <p>{{ $slide->pivot->description ?? config('global.general.description') }}</p>
                <a class="btn cta" href="{{ $slide->pivot->url }}">Read more</a>
            </div>
        </li>
    @endforeach
</div>
