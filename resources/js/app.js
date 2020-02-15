require('./bootstrap');

$(document).ready(function() {
    $('#filter-button').click(() => {
        const crud = document.getElementById('log-crud').value;
        const type = document.getElementById('log-type').value;
        
        $("#logs-table .alert").each(function() {
            if (($(this).attr('data-crud') == crud || crud == 0) && ($(this).attr('data-type') == type || type === 0)) {
                $(this).show();
            } else if (crud == 0 && type == 0) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });   
})