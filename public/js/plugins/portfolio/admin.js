function appendThumbnails(response) {
    const items = response.data.files;
    items.forEach(el => {
        if (!$('#pictures .picture[data-id="' + el.id + '"]').length > 0) {
            let html = `
                <div class="d-inline-block mr-2 position-relative picture" data-id="${el.id}">
                    <button type="button" class="close position-absolute mt-1" style="right: 5px;" aria-label="Close" data-id="${el.id}">
                        <span aria-hidden="true">×</span>
                    </button>
                    <img height="100" width="100" src="/images/${el.path}" class="border border-dark" alt="photo">
                </div>
            `;
            $("#pictures").append(html);
        }
    });
}

function appendCategory(response) {
    const category = response.data.category;
    if (
        !$('#assigned_categories .tag[data-id="' + category.id + '"]').length >
        0
    ) {
        $("#assigned_categories").append(
            '<span class="tag mr-1" data-id="' +
                category.id +
                '">' +
                category.name +
                '<small class="close">x</small></span>'
        );
    }
}

function appendContentBox(response) {
    const html = `
        <div class="portfolio_content_box">
            <div class="form-group">
                <label for="content[${response.data.id}][title]">Title:</label>
                <input class="form-control" name="content[${response.data.id}][title]" type="text">
            </div>

            <div class="form-group">
                <label for="content[${response.data.id}][content]">Content:</label>
                <textarea class="form-control" name="content[${response.data.id}][content]" cols="50" rows="10"></textarea>
            </div>

            <hr>
        </div>`;

    $("#content-boxes").append(html);
}

async function attach($file) {
    console.log($file);
    try {
        const response = await axios.post(endpoints.attachMedia, {
            file: $file
        });
        appendThumbnails(response);
    } catch (error) {
        console.log(error);
    }
}

async function detach($file) {
    try {
        const response = await axios.post(endpoints.detachMedia, {
            file: $file
        });
        const photo = $('.picture[data-id="' + $file + '"]');
        photo.remove();
    } catch (error) {
        console.log(error);
    }
}

const categoryDetach = async id => {
    try {
        const response = await axios.post(endpoints.detachCategory, {
            category: id
        });
        const category = $(
            '#assigned_categories .tag[data-id="' +
                response.data.category +
                '"]'
        );
        category.remove();
    } catch (error) {
        console.log(error);
    }
};

const categoryAttach = async id => {
    try {
        const response = await axios.post(endpoints.attachCategory, {
            category: id
        });
        appendCategory(response);
    } catch (error) {
        console.log(error);
    }
};

const contentAttach = async () => {
    try {
        const response = await axios.post(endpoints.attachContent, {});
        appendContentBox(response);
    } catch (error) {
        console.log(error);
    }
};

const contentDetach = async id => {
    try {
        const response = await axios.post(endpoints.detachContent, {
            content: id
        });
        $(
            '.portfolio_content_box[data-id="' + response.data.id + '"]'
        ).remove();
    } catch (error) {
        console.log(error);
    }
};

$(document).ready(function() {
    var CSRF_TOKEN = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    Dropzone.autoDiscover = false;
    var portfolioDropZone = new Dropzone("#portfolio_attach_modal_dropzone", {
        maxFilesize: 3,
        acceptedFiles: ".jpeg,.jpg,.png,.pdf"
    }).on("sending", function(file, xhr, formData) {
        formData.append("_token", CSRF_TOKEN);
    });

    portfolioDropZone.on("success", function($response) {
        attach($response.xhr.response);
    });

    $("#add-pictures").click(function() {
        $("#portfolio_attach_modal").fadeIn();
    });

    $("#portfolio_attach_modal_slider-add-existing").click(function() {
        var slides = [];
        $("#portfolio_attach_modal input[name^='mass_edit']:checked").each(
            function() {
                slides.push($(this).val());
            }
        );
        attach(slides);
        $(".fade").fadeOut();
    });

    $("#module").on("click", "#pictures .close", function(e) {
        const id = $(this).attr("data-id");
        detach(id);
    });

    $('input[type="color"]').change(function() {
        const value = $(this).val();
        const rel_attr = $(this).data("color");

        console.log(rel_attr);
        const related = $("#" + rel_attr);

        if (related) {
            related.val(value);
        }
    });

    $("#module").on("click", "#assigned_categories .close", function(e) {
        const category = $(this)
            .closest(".tag")
            .data("id");
        categoryDetach(category);
    });

    $("#assign_category").click(function() {
        const category = $("#new_category").val();
        categoryAttach(category);
    });

    $("#add-content-box").click(function() {
        contentAttach();
    });

    $(".portfolio_content_box .close").click(function() {
        const id = $(this)
            .closest(".portfolio_content_box")
            .data("id");
        contentDetach(id);
    });
});
