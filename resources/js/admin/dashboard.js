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