<div id="{{ $key }}" class="slider" style="max-height: 600px;">
    @foreach($block['slider']->files as $slide)
        <li class="slide">
            <img src="/images/{{ $slide->path }}">
        </li>
    @endforeach
</div>
