function getWidgetsArray() {
    var widgets = [];
    var rows = document.querySelectorAll('#dashboard .row');
    rows.forEach((row, key) => {
        var rowWidgets = row.querySelectorAll('.placeholder');
        var rkey = row.getAttribute('data-key');
        widgets[rkey] = [];
        
        rowWidgets.forEach((widget, wkey) => {
            var name = widget.getAttribute('data-name');
            var size = widget.getAttribute('data-size');
            widgets = {
                ...widgets,
                [rkey] : {
                    "name": document.getElementById('row['+rkey+']').value,
                    "widgets": {
                        ...widgets[rkey]['widgets'],
                        [name] : size
                    }
                }
            }

        });
    
    });
    document.getElementById('widgets_array').value = JSON.stringify(widgets);
}

$(document).ready(function() {
    $('.add-control').click(function() {
        if ($(this).attr('data-create')) {
 
            switch($(this).attr('data-create')) {
                case "row":
                    
                    var html = `
                        <div class="form-group px-0 col-md-3">
                            <input type="text" id="row[${ $('#dashboard .row').length }]" class="form-control" placeholder="Name of row" required>
                        </div>
                        <div class="row" data-key="${ $('#dashboard .row').length }"></div>
                    `;

                    $('#dashboard').append(html);
                break;
            }
 
        } else if ($(this).attr('data-add')) {
          
            var html = `
                <div class="placeholder col-lg-${ $(this).attr('data-size') * 4 }" data-size="${ $(this).attr('data-size') }" draggable="true" id="${ $(this).attr('data-name') }" data-name="${ $(this).attr('data-add') }" ondragstart="drag(event)">
                    <div style="height: 65px;" class="card my-2">
                        <div class="card-body">
                            <div class="card-title">
                                ${ $(this).attr('data-title') }
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('#dashboard .row.active').append(html);
        }

        $('#dashboard .row').click(function() {
            $('#dashboard .row.active').removeClass('active');
            $(this).addClass('active');
        });
    });

    $('#dashboard .row').click(function() {
        $('#dashboard .row.active').removeClass('active');
        $(this).addClass('active');
    });

    $("#dashboard-form").submit(function() {
        getWidgetsArray();
    });
});