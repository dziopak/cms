<script type="text/javascript">
    var grid = GridStack.init();


    $('.add-widget').click(function() {
        var name = $(this).attr('data-name');
        $.get( `{{ route('admin.layouts.getwidget') }}?name=${name}`, function( html ) {
            if (typeof html === "string") {

                name = name+"-block";
                var id = '#'+name;

                // Append new widget and auto position it
                $('#layout').append(html);
                grid.addWidget($(id));

                // Replace id with data param
                $(id).attr('data-gs-block', name);
                $(id).removeAttr('id');

                // Update onClick event for new item
                $('.widget-remove').click(function() {
                    $(this).closest('.grid-stack-item').remove();
                });
            }
        });
    });
</script>
