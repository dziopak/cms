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
});
