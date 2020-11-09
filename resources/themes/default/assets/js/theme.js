$(document).ready(function() {
    $( ".horizontal-menu__list-item" ).hover(
      function() {
        if (!$(this).hasClass('cta')) {
            $('.horizontal-menu__underline').css({
                'opacity': '1',
                'width': $(this).outerWidth()
            }).offset({
                left: $(this).offset().left
            });;
        }

    }, function() {
        $('.horizontal-menu__underline').css('opacity', '0');
    }
    );

    $('.horizontal-menu--main .horizontal-menu__close').click(function() {
        $('.horizontal-menu').fadeOut(100);
        setTimeout(function() {
            $('body').css('overflow-y', 'scroll')
        }, 100);
    });

    $('.horizontal-menu__toggle').click(function() {
        $('body').css('overflow-y', 'hidden')
        $('.horizontal-menu').css("display", "flex")
        .hide()
        .fadeIn(100);
    });
});
