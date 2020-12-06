<div class="menu-item-option">

    {{-- Search input --}}
    <div class="form-group">
        {!! Form::label('item_search', __('admin/blocks/menus.item_search').':') !!}
        <div class="input-group md-form form-sm form-1 pl-0">
            <div class="input-group-prepend search-entries">
            <span class="input-group-text purple lighten-3 bg-primary"><i class="fa fas fa-search text-white"
                aria-hidden="true"></i></span>
            </div>
            <input class="form-control my-0 py-1 item_search" name="item_search" type="text" placeholder="Search" aria-label="Search">
        </div>
    </div>


    {{-- Search result list --}}
    <ul class="menu-entry-list mt-2">
        <p>No search yet.</p>
    </ul>
</div>


