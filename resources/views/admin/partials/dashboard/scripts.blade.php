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
    // grid.on('resize', function(param) {
    //     console.log(param);
    // });
    grid.on('change', function(grid, items) {
        saveDashboard();

        items.forEach(el => {
            console.log(el);
            var sizeY = el.height;
            var sizeW = el.width;
            
            for(var i = 1; i < 10; i++) {
                if (i < sizeY) {
                    $(el.el).find('.hide-y-'+i).show();
                    $(el.el).find('.show-y-'+i).hide();
                } else {
                    $(el.el).find('.hide-y-'+i).hide();
                    $(el.el).find('.show-y-'+i).show();
                }
            }

            // for(var i = 1; i < 12; i++) {
            //     if (i < sizeX) {
            //         $(el.el).find('.hide-x-'+i).show();
            //         $(el.el).find('.show-x-'+i).hide();
            //     } else {
            //         $(el.el.find('.hide-x-'+i).hide();
            //         $(el.el.find('.show-x-'+i).show();
            //     }
            // }
        });

        

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

    $(document).ready(function() {
        $('.grid-stack-item').each(function() {
            var sizeY = $(this).data('gs-height');
            var sizeX = $(this).data('gs-width');

            
            for(var i = 1; i < 10; i++) {
                if (i < sizeY) {
                    $(this).find('.hide-y-'+i).show();
                    $(this).find('.show-y-'+i).hide();
                } else {
                    $(this).find('.hide-y-'+i).hide();
                    $(this).find('.show-y-'+i).show();
                }
            }

            for(var i = 1; i < 12; i++) {
                if (i < sizeX) {
                    $(this).find('.hide-x-'+i).show();
                    $(this).find('.show-x-'+i).hide();
                } else {
                    $(this).find('.hide-x-'+i).hide();
                    $(this).find('.show-x-'+i).show();
                }
            }
        });

        $('.widget-remove').click(function() {
            $(this).closest('.grid-stack-item').remove();
            saveDashboard();
        });
    });
</script>