<script type="text/javascript">
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

    var grid = GridStack.init({
        
    });
    grid.on('change', function() {
        saveDashboard();
    });

    $('.add-widget').click(function() {
        var name = $(this).attr('data-name');
        $.get( `{{ route('admin.dashboard.getwidget') }}?name=${name}`, function( html ) {
            if (typeof html === "string") {
                $('#dashboard').append(html);
                grid.addWidget($('#'+name));
                $('#'+name).removeAttr('id');
                saveDashboard();
            }
        });
    });

    $('#toggle-components').click(function() {
        var components = $('#dashboard-components');
        if (!components.hasClass('active')) {
            components.addClass('active');
            $(this).addClass('active');
        } else {
            components.removeClass('active');
            $(this).removeClass('active');
        }
    });
</script>