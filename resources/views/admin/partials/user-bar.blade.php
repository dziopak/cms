<div id="user-bar" class="text-center mx-3">
    <a href=""><i class="fa fas fa-envelope"></i></a>
    @if (Auth::user()->photo) <img src="{{ getPublicPath() }}/images/{{ Auth::user()->photo->path }}" class="rounded-circle mx-3 border border-dark" width="30" alt={{ Auth::user()->name }}> @endif
    <a href=""><i class="fa fas fa-bell"></i></a>
</div>