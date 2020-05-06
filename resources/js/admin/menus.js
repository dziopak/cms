import { postCall } from "./imports/ajax";
import { removeNode } from "./imports/DOMHelpers";

// SEARCH FUNCTIONS
const searchResponse = response => {
    if (response.data.items) {
        var list = $(".menu-entry-list");
        list.html("");

        var res = response.data.items;
        res.forEach(el => {
            var html = `<li class="list-group-item" data-id="${el.id}">
                <button class="menu-add-button" data-url="${el.url}" data-label="${el.name}">+</button>
                ${el.name}
            </li>`;
            list.append(html);
        });
    }
};

$(".search-entries").click(function() {
    var data = {
        type: [],
        query: $(this)
            .closest(".menu-item-option")
            .find(".item_search")
            .val()
    };
    $(".item-type-check:checked").each(function() {
        data.type.push($(this).val());
    });

    let url = endpoints.search;
    postCall(url, data, searchResponse);
});

// ADD ITEM FUNCTIONS
const addItemCallback = response => {
    const { id } = response.data;
    const { data } = response.data;
    $("#menu-items ol:first-child").append(`
        <li class="list-group-item dd-item" data-id="${id}" data-label="${data.label}" data-url="${data.link}">
            <button class="remove">x</button>
            <div class="dd-handle">${data.label}</div>
        </li>
    `);
    updateOutput();
};

$("#menu-add-item").click(function() {
    postCall(
        endpoints.addItem,
        {
            label: $("#item_label").val(),
            link: $("#item_url").val(),
            parent: 0
        },
        addItemCallback
    );
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

/* JQUERY FUNCTIONS */
// Set url and title of entry
$(".menu-entry-list").on("click", ".menu-add-button", function(e) {
    $(".menu-add-button").each(function() {
        $(this).removeClass("active bg-success text-white");
    });
    $(this).addClass("active bg-success text-white");
    $("#item_url").val($(this).attr("data-url"));
    $("#item_label").val($(this).attr("data-label"));
});

$(document).ready(() => {
    // Set visibility of extra tabs
    $("#item_type").change(() => {
        typeChange();
    });
    typeChange();

    // Init Nestable
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

const typeChange = () => {
    const type = $("#item_type").val();
    if (type === "entries") {
        $(".menu-item-option").show();
    } else {
        $(".menu-item-option").hide();
    }
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
