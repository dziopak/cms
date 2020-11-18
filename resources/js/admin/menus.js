import { postCall } from "./imports/ajax";
import { removeNode } from "./imports/DOMHelpers";

// SEARCH FUNCTIONS
const searchResponse = response => {
    if (response.data.items) {
        var list = $(".menu-entry-list");
        list.html("");

        console.log(response);
        var res = response.data.items;
        res.forEach(el => {
            var html = `<li class="list-group-item">
                <button class="menu-add-button" data-label="${el.name}" data-type="${el.type}" data-id="${el.id}">+</button>
                ${el.name}
            </li>`;
            list.append(html);
        });
    }
};

const addItemCallback = response => {
    const { id } = response.data;
    const { data } = response.data;

    console.log(data);

    let html = `<li class="list-group-item dd-item" data-id="${id}" data-label="${data.label}" data-relation-id="${data.model_id ?? ''}" data-relation-type="${data.model_type ?? ''}" data-url="${data.link ?? ""}" data-class="${data.class}">`

    html += `
        <button class="edit btn btn-primary">Edit</button>
        <button class="remove">x</button>
        <div class="dd-handle">${data.label}</div>
    </li>`;

    $("#menu-items ol:first-child").append(html);
    updateOutput();
};

const updateItemCallback = response => {
    const { data } = response.data;
    $('#menu-items li[data-id="' + data.id + '"] .dd-handle').text(data.label);
    $('#menu-items li[data-id="' + data.id + '"]').attr({
        "data-label": data.label,
        "data-link": data.url,
        "data-class": data.class
    });
};

const cleanFields = () => {
    $('#item_url, #item_type').closest('.form-group').show();
    $("#item_label").val("");
    $("#item_class").val("");
    $("#item_url").val("");
};

const updateOutput = () => {
    var data = [];
    var sort = [];

    $("#menu-items .list-group-item").each(function() {
        var parent =
            $(this)
                .parent("ol")
                .parent("li")
                .attr("data-id") || 0;

        if (!sort[parent]) sort[parent] = 0;

        data[$(this).attr("data-id")] = {
            parent,
            sort: sort[parent]
        };

        sort[parent] += 1;
    });

    postCall(endpoints.order, data, () => {});
};


const entryTypeChange = $value => {
    var link = $('#item_url').closest('.form-group');

    if ($value == 0) {
        link.show();
        $('.menu-item-option').hide();
    } else {
        link.hide();
        $('.menu-item-option').show();
    }
}

$(".search-entries").click(function() {
    var data = {
        type: [],
        query: $(this)
            .closest(".menu-item-option")
            .find(".item_search")
            .val(),
        type: $('#entry-type').val()
    };

    let url = endpoints.search;
    postCall(url, data, searchResponse);
});



$("#menu-add-item").click(function() {
    if ($(this).data("action") === "update") {
        postCall(
            endpoints.updateItem,
            {
                id: $("#menu-items button.edit.active")
                    .closest("li")
                    .data("id"),
                label: $("#item_label").val(),
                link: $("#item_url").val(),
                class: $("#item_class").val()
            },
            updateItemCallback
        );
    } else {
        let conditions = [];
        $('.menu-condition').each(function() {
            if ($(this).is(':checked')) {
                conditions.push($(this).val());
            }
        });

        let itemData = {
            label: $("#item_label").val(),
            link: $("#item_url").val(),
            class: $("#item_class").val(),
            model_id: $("#item_model_id").val(),
            model_type: $("#item_model_type").val(),
            conditions: conditions,
            parent: 0
        }

        postCall(
            endpoints.addItem,
            itemData,
            addItemCallback
        );
    }
});

// REMOVE ITEM FUNCTIONS
$("#menu-items").on("click", ".list-group-item .remove", function(e) {
    const id = $(this)
        .closest("li")
        .attr("data-id");
    let url = endpoints.remove;
    url = url.replace("||ID||", id);

    postCall(url, {}, response => {
        removeNode($('#menu-items li[data-id="' + response.data.id + '"]'));
    });
});

// EDIT ITEM FUNCTIONS
$("#menu-items").on("click", ".list-group-item .edit", function(e) {
    const item = $(this).closest("li");
    const data = item.data();
    const button = $("#menu-add-item");

    const urlField = $('#item_url').closest('.form-group');

    cleanFields();


    if (!$(this).hasClass("active")) {

        $("#menu-items li button.active").removeClass("active");
        $(this).toggleClass("active");


        if (item.data('relation-id') && item.data('relation-type')) {
            urlField.hide();

            postCall(endpoints.find, {
                'type': item.data('relation-type'),
                'id': item.data('relation-id')
            }, response => {
                console.log(response);
            });
        }



        $("#item_label").val(data.label);
        $("#item_class").val(data.class);
        $("#item_url").val(data.link);

        button.attr("data-action", "update");
        button.html(button.data("update-message"));
    } else {
        $(this).removeClass("active");
        button.attr("data-action", "add");
        button.html(button.data("add-message"));
    }
});


$(".menu-entry-list").on("click", ".menu-add-button", function(e) {
    $(".menu-add-button").each(function() {
        $(this).removeClass("active bg-success text-white");
    });
    $(this).addClass("active bg-success text-white");
    $("#item_label").val($(this).attr("data-label"));
    $("#item_model_id").val($(this).attr("data-id"));
    $("#item_model_type").val($(this).attr("data-type"));
    console.log($(this).data());
});



$('#entry-type').change(function() {
    entryTypeChange($(this).val());
});

$(document).ready(function() {
    entryTypeChange(0);

    $("#menu-items")
        .nestable({
            placeClass: "list-group-item placeholder",
            dragClass: "list-group-item",
            collapseBtnHTML:
                "<button class='collapse-button' data-action='collapse'>-</button>",
            expandBtnHTML:
                "<button class='collapse-button' data-action='expand'>+</button>",
            maxDepth: 2
        })
        .on("change", updateOutput);
});
