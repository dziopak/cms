function resizeElementContent(sizeX, sizeY, el) {
    for(var i = 1; i < 10; i++) {
        if (i < sizeY) {
            $(el).find('.hide-y-'+i).show();
            $(el).find('.show-y-'+i).hide();
        } else {
            $(el).find('.hide-y-'+i).hide();
            $(el).find('.show-y-'+i).show();
        }
    }
    
    for(var i = 1; i < 10; i++) {
        if (i < sizeX) {
            $(el.el).find('.hide-x-'+i).show();
            $(el.el).find('.show-x-'+i).hide();
        } else {
            $(el.el).find('.hide-x-'+i).hide();
            $(el.el).find('.show-x-'+i).show();
        }
    }
}

$(document).ready(function() {
    $('.grid-stack-item').each(function() {
        var sizeY = $(this).data('gs-height');
        var sizeX = $(this).data('gs-width');
  
        resizeElementContent(sizeX, sizeY, this);
    });

    $('.widget-remove').click(function() {
        $(this).closest('.grid-stack-item').remove();
        saveDashboard();
    });

    var grid = GridStack.init();
    grid.on('change', function(grid, items) {
        saveDashboard();
        items.forEach(el => {
            var sizeY = el.height;
            var sizeX = el.width;
            
            resizeElementContent(sizeX, sizeY, el.el);
        });
    });
    
    $('#dashboard-components').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 2,
        arrows: true
    });
    $('#dashboard-components .slick-arrow').hide();

    $('#toggle-components').click(function() {
        var components = $('#dashboard-components');
        setTimeout(function() {
            if (!components.hasClass('active')) {
                $('#toggle-components').addClass('active')
                $('#dashboard-components').addClass('active')
                $('#dashboard-components').slick('setPosition');
                document.getElementById('dashboard-components').scrollIntoView();
                setTimeout(function() {
                    $('#dashboard-components .slick-arrow').fadeIn(40);
                }, 10);
            } else {
                $('#toggle-components').removeClass('active');
                $('#dashboard-components').removeClass('active');
                $('#dashboard-components .slick-arrow').fadeOut(40);
            }
        }, 100);
    });
  });