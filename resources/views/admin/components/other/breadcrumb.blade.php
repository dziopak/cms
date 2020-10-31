<li>
    @if ($route)
        <a href="{{route($route)}}">{{ __($name) }}</a>
    @else
        {{ __($name) }}
    @endif
</li>
