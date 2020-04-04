$(document).ready(function() {

    // TinyMCE //
    if ($('.tinymce').length > 0) {
        var editor_config = {
            path_absolute : "/",
            selector: "textarea.tinymce",
            plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
            toolbar1: "undo redo | styleselect formatselect insertfile | bold italic strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | removeformat",
            toolbar2: 'bullist numlist | link image media numlist bullist',
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
        
            var cmsURL = editor_config.path_absolute + 'admin/filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }
        
            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
            }
        };
        
        tinymce.init(editor_config);
    }

    // MASS EDIT //
  var selectAll = $('.select-all');
  selectAll.change(() => {
    selectAll.closest('table').find('input').prop('checked', selectAll.prop('checked'))
  });

  $("#mass_action").change(function(e) {
      $(".mass_edit_sub").hide();
      if ($("#"+e.target.value)) {
        $("#"+e.target.value).show();
      }
    });

    // LOGS //
    $('#filter-button').click(() => {
        const crud = document.getElementById('log-crud').value;
        const type = document.getElementById('log-type').value;
        
        $("#logs-table .alert").each(function() {
            if (($(this).attr('data-crud') == crud || crud === "0") && ($(this).attr('data-type') == type || type === "0")) {
                $(this).show();
            } else if (crud == 0 && type == 0) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      var target = '#'+$(input).attr('id')+'-image-preview';

      reader.onload = function(e) {
        $(target).attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
  
  
  $(document).ready(function() {
        
    $("input[type='file']").change(function() {
        readURL(this);
    });
    
});
