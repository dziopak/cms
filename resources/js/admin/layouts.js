var glideConfig = {
    type: 'carousel',
    startAt: 3,
    perView: 5,
    focusAt: 'center',
    gap: 30,
    breakpoints: {
        800: { perView: 1 },
        1300: { perView: 3 },
    }
};


var gridstackConfig = {
    acceptWidgets: true,
    animate: true,
    minRow: 10,
    disableOneColumnMode: true,
    minWidth: 300,
    infinity: true,
    float: true,
    autoPosition: true
}


function triggerResize() {
    setTimeout(function() {
        document.querySelector('body').style.width = '100%';
        document.querySelector('body').style.width = '100vw';
    }, 100);
}


$(document).ready(function() {
    var LayoutComponents = new Glide('#layout-components', glideConfig).mount();
    var grid = GridStack.init(gridstackConfig);

    $(".widget-container").each(function() {
        var container = $(this)
            .closest(".card")
            .find(".with-container")
            .val();

        if (container == true) {
            $(this).addClass("active");
        }
    });

    $(".block-title").change(function() {
        var title = $(this).val();
        var key = $(this)
            .closest(".block-settings")
            .attr("key");

        $(
            '.grid-stack-item[data-gs-key="' + key + '"] .card-title strong'
        ).text(title);
    });


    $("#LayoutUpdateForm").on("click", ".widget-container", function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();

        $(this).toggleClass("active");
        var key = $(this).attr("data-key");

        if ($(this).hasClass("active")) {
            $('input[name="config[' + key + '][container]"]').attr(
                "value",
                "true"
            );
        } else {
            $('input[name="config[' + key + '][container]"]').attr(
                "value",
                "false"
            );
        }
    });

    $(".grid-stack-item").on("click", ".block-settings", function(e) {
        e.preventDefault();
    });

    $("#module").on("click", "#fade, .block-settings button.btn", function(e) {
        $("#fade").fadeOut("100");
        $(".block-settings").fadeOut("100");
        $(".block-settings").removeClass('active').fadeOut("50");
    });

    $("#module").on("click", ".grid-stack-item .card-title strong", function(e) {
        var key = $(this).closest('.grid-stack-item').attr("data-gs-key");

        if (!$('.block-settings[key="' + key + '"]').hasClass('active')) {
            $(".block-settings").removeClass('active').fadeOut("50");
            $('.block-settings[key="' + key + '"]').addClass('active');

            if (key) {
                setTimeout(function() {
                    $("#fade").fadeIn("100");
                    $('.block-settings[key="' + key + '"]').fadeIn("100");
                }, 300);
            }
        }
    });

    $(".widget-remove").click(function() {
        $(this)
            .closest(".grid-stack-item")
            .remove();
    });

    $("#toggle-components").click(function() {
        var components = $("#layout-components, #existing-components");
        if (!components.hasClass("active")) {
            $("#toggle-components").addClass("active");
            components.addClass("active");
            // document.scrollIntoView();
        } else {
            components.removeClass("active");
        }

        triggerResize();
    });

    $('button[type="submit"]').click(function(e) {
        e.preventDefault();

        var items = [];
        $(".grid-stack-item").each(function() {
            var $this = $(this);
            var key = $this.attr("data-gs-key");
            var config;

            $(
                "input[name^='config[" +
                    key +
                    "]'], select[name^='config[" +
                    key +
                    "]']"
            ).each(function() {
                var value = $(this).val();

                if (value) {
                    var name = $(this).attr("name");
                    name = name.split(/[[\]]{1,2}/);

                    config = {
                        ...config,
                        [name[2]]: $(this).val()
                    };
                }
            });

            var data = {
                x: $this.attr("data-gs-x"),
                y: $this.attr("data-gs-y"),
                w: $this.attr("data-gs-width"),
                h: $this.attr("data-gs-height"),
                type:
                    $this.attr("data-gs-block") || $this.attr("data-gs-widget"),
                id: $this.attr("data-gs-block-id"),
                key: key
            };

            items.push(data);
        });

        if ($("#result").length > 0) {
            $("#result").val(JSON.stringify(items));
        } else {
            var html = `<input type="hidden" id="result" value='${JSON.stringify(
                items
            )}' name="result">`;
            $("#LayoutUpdateForm, #LayoutCreateForm").append(html);
        }
        $("#LayoutUpdateForm, #LayoutCreateForm").submit();
    });

});
