<div id="global-search" class="text-right ml-3">
    <form id="search-form" action="{{ route('admin.search') }}" method="GET">
        <input class="form-control-blended" type="text" name="query" value="{{ request()->get('query') }}" placeholder="Search...">
        <button type="submit"><i class="fa fas fa-search"></i></button>
    </form>
</div>
