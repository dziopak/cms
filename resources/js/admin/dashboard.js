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
  });

  $(document).ready(function() {
    $('.widget-remove').click(function() {
        $(this).closest('.grid-stack-item').remove();
        grid.init();
        saveDashboard();
    });

    var grid = GridStack.init();
    grid.on('change', function(grid, items) {
        saveDashboard();
        items.forEach(el => {
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

    $('#dashboard-components').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 2,
        arrows: false
    });

    $('#toggle-components').click(function() {
        var components = $('#dashboard-components');
        components.toggle();

        setTimeout(function() {
            if (components.is(':visible')) {
                $('#dashboard-components').slick('setPosition');
                document.getElementById('dashboard-components').scrollIntoView();
            }
        }, 100);
    });
  });