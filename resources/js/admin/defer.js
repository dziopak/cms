$(document).ready(function() {
    // TinyMCE //
    if ($(".tinymce").length > 0) {
        tinymce.init({
            selector: "textarea.tinymce",
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar1: 'numlist bullist | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl | undo redo |',
            toolbar2: 'fontselect fontsizeselect formatselect | forecolor backcolor removeformat | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent |',
            toolbar_sticky: false,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            font_formats: "Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats; Poppins=Poppins,helvetica,sans-serif;",
            fontsize_formats: "10px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 32px 34px 36px 38px 40px",
            image_class_list: [
              { title: 'None', value: '' },
              { title: 'Left-aligned', value: 'img-left' },
              { title: 'Right-aligned', value: 'img-right' }
            ],
            setup : function(ed)
            {
                ed.on('init', function()
                {
                    this.getDoc().body.style.fontSize = '16';
                    this.getDoc().body.style.fontFamily = 'Poppins';
                });
            },
            importcss_append: true,
            file_picker_callback: function (callback, value, meta) {
              /* Provide file and text for the link dialog */
              if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
              }

              /* Provide image and alt text for the image dialog */
              if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
              }

              /* Provide alternative source and posted for the media dialog */
              if (meta.filetype === 'media') {
                callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
              }
            },
            templates: [
                  { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
              { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
              { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 1190,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            content_style: 'body { font-family:Poppins,Arial,sans-serif; font-size:16px } .img-left { margin-left: 0px; margin-right: 20px; } .img-right { margin-right: 0px; margin-left: 20px; }'
           });
    }

    // MASS EDIT //
    var selectAll = $(".select-all");
    selectAll.change(() => {
        selectAll
            .closest("table")
            .find("input")
            .prop("checked", selectAll.prop("checked"));
    });

    $("#mass_action").change(function(e) {
        $(".mass_edit_sub").hide();
        if ($("#mass_" + e.target.value)) {
            $("#mass_" + e.target.value).show();
        }
    });

    // LOGS //
    $("#filter-button").click(() => {
        const crud = document.getElementById("log-crud").value;
        const type = document.getElementById("log-type").value;

        $("#logs-table .alert").each(function() {
            if (
                ($(this).attr("data-crud") == crud || crud === "0") &&
                ($(this).attr("data-type") == type || type === "0")
            ) {
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
        var target = "#" + $(input).attr("id") + "-image-preview";

        reader.onload = function(e) {
            $(target).attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$(document).ready(function() {
    $("input[type='file']").change(function() {
        readURL(this);
    });

    $("#fade, #modal-cancel").click(function(event) {
        if (!$(this).hasClass('layout-edit')) {
            $("#fade").fadeOut();
        }
    });

    $(".fade").click(function() {
        $(this).fadeOut();
    });

    $("#fade *, .fade *").click(function(event) {
        event.stopPropagation();
    });

    $(".modal-nav li").click(function() {
        const tab = $(this).attr("data-tab") || 1;

        $(".modal-nav li.active").removeClass("active");
        $(this).addClass("active");

        $(".modal-tab").hide();
        $('.modal-tab[data-tab="' + tab + '"]').show();
    });

    $(".modal-action").click(function() {
        $("#fade").fadeIn();

        var url = $(this).attr("data-route");
        if (url) {
            $("#modal-confirm").attr("data-route", url);
        }
    });

    function tableRowDelete(res) {
        $('.data-list-table tr[data-row="' + res.data.id + '"]').remove();
        $("#fade").hide();
    }

    async function axiosDelete(route, callback = null) {
        axios
            .delete(route)
            .then(function(response) {
                callback(response);
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    $("#modal-confirm").click(function() {
        var url = $(this).attr("data-route");
        if (url) {
            var action = $(this).attr("data-type");

            switch (action) {
                case "delete":
                    axiosDelete(url, tableRowDelete);
                    break;
            }
        }
    });
});
