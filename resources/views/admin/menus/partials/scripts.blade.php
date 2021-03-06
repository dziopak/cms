<script defer>
    var endpoints = {
        search: '{{ route("admin.blocks.menus.search.items") }}',
        find: '{{ route("admin.blocks.menus.find") }}',
        addItem: '{{ route("admin.blocks.menus.attach", $menu->id) }}',
        updateItem: '{{ route("admin.blocks.menus.attach", $menu->id) }}',
        remove: '{{ route("admin.blocks.menus.detach", ["menu_id" => $menu->id, "item_id" => "||ID||"]) }}',
        order: '{{ route("admin.blocks.menus.order", $menu->id) }}'
    };
</script>
