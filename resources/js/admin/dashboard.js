var glideConfig = {
    type: 'carousel',
    startAt: 3,
    perView: 4,
    focusAt: 1,
    gap: 30,
    breakpoints: {
        800: { perView: 1 },
        1200: { perView: 3 },
    }
};

function triggerResize() {
    setTimeout(function() {
        document.querySelector('body').style.width = '100%';
        document.querySelector('body').style.width = '100vw';
    }, 100);
}

function resizeElementContent(sizeX, sizeY, el) {
    for (var i = 1; i < 10; i++) {
        if (i < sizeY) {
            $(el)
                .find(".hide-y-" + i)
                .show();
            $(el)
                .find(".show-y-" + i)
                .hide();
        } else {
            $(el)
                .find(".hide-y-" + i)
                .hide();
            $(el)
                .find(".show-y-" + i)
                .show();
        }
    }

    for (var i = 1; i < 10; i++) {
        if (i < sizeX) {
            $(el.el)
                .find(".hide-x-" + i)
                .show();
            $(el.el)
                .find(".show-x-" + i)
                .hide();
        } else {
            $(el.el)
                .find(".hide-x-" + i)
                .hide();
            $(el.el)
                .find(".show-x-" + i)
                .show();
        }
    }
}

$(document).ready(function() {
    $(".grid-stack-item").each(function() {
        var sizeY = $(this).data("gs-height");
        var sizeX = $(this).data("gs-width");
        $(this).removeAttr("id");

        resizeElementContent(sizeX, sizeY, this);
    });

    $(".widget-remove").click(function() {
        $(this)
            .closest(".grid-stack-item")
            .remove();
        saveDashboard();
    });

    var grid = GridStack.init();
    var LayoutComponents = new Glide('#dashboard-components', glideConfig).mount();

    grid.on("change", function(grid, items) {
        saveDashboard();
        items.forEach(el => {
            var sizeY = el.height;
            var sizeX = el.width;

            resizeElementContent(sizeX, sizeY, el.el);
        });
    });

    $("#toggle-components").click(function() {
        var components = $("#dashboard-components");
            if (!components.hasClass("active")) {
                $("#toggle-components").addClass("active");
                $("#dashboard-components").addClass("active");
                document
                    .getElementById("dashboard-components")
                    .scrollIntoView();

                    $("#dashboard-components .glide__arrow").fadeIn(400);
            } else {
                $("#toggle-components").removeClass("active");
                $("#dashboard-components").removeClass("active");
                    $("#dashboard-components .glide__arrow").fadeOut(400);
            }
    });
});
