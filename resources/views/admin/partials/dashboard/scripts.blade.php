<script type="text/javascript">
    var grid = GridStack.init();

    function saveDashboard() {
        var items = [];

        $('.grid-stack-item.ui-draggable').each(function () {
            var $this = $(this);
            items.push({
                x: $this.attr('data-gs-x'),
                y: $this.attr('data-gs-y'),
                w: $this.attr('data-gs-width'),
                h: $this.attr('data-gs-height'),
                id: $this.attr('data-gs-widget'),
            });
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('admin.dashboard.update') }}",
            method: 'post',
            data: {
                'items': items
            }
        });
    }
    
    $('.add-widget').click(function() {
        var name = $(this).attr('data-name');
        $.get( `{{ route('admin.dashboard.getwidget') }}?name=${name}`, function( html ) {
            if (typeof html === "string") {
                
                // Append new widget and auto position it
                $('#dashboard').append(html);
                grid.addWidget($('#'+name));
                
                // Scroll to new widget
                document.getElementById(name).scrollIntoView();
                $('#'+name).removeAttr('id');

                // Save widgets positions
                saveDashboard();

                // Update onClick event for new item
                $('.widget-remove').click(function() {
                    $(this).closest('.grid-stack-item').remove();
                    saveDashboard();
                });
            }
        });
    });
</script>