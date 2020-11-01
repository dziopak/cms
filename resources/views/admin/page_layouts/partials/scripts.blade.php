<script type="text/javascript">
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

                $(".grid-stack-item .card-title").click(function() {
                    var key = $(this)
                        .closest(".grid-stack-item")
                        .attr("data-gs-key");

                    $(".block-settings").fadeOut("50");
                    if (key) {
                        setTimeout(function() {
                            $("#fade").fadeIn("100");
                            $('.block-settings[key="' + key + '"]').fadeIn("100");
                        }, 300);
                    }
                });
                $("#fade, .block-settings button").click(function(e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    $("#fade").fadeOut("100");
                    $(".block-settings").fadeOut("100");
                });
            }
        });
    });
</script>
