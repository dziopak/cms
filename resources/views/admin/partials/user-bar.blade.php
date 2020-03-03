<div class="float-right mr-3">
    <a href="" class="btn btn-sm btn-light px-4" >{{ Auth::user()->name }}<img src="{{ getPublicPath() }}/images/{{ Auth::user()->photo->path }}" class="rounded-circle ml-3 border border-dark" width="30" alt={{ Auth::user()->name }}></a>
    @hook('top-nav-user-bar')
</div>