$(document).ready(function() {
    GridStack.init({
        acceptWidgets: true,
        animate: true,
        minRow: 10
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

    $(".grid-stack-item").click(function() {
        var key = $(this).attr("data-gs-key");

        $(".block-settings").fadeOut("50");
        if (key) {
            setTimeout(function() {
                $("#fade").fadeIn("100");
                $('.block-settings[key="' + key + '"]').fadeIn("100");
            }, 300);
        }
    });

    $("#fade, .block-settings button").click(function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $("#fade").fadeOut("100");
        $(".block-settings").fadeOut("100");
    });

    $(".widget-remove").click(function() {
        $(this)
            .closest(".grid-stack-item")
            .remove();
    });

    $("#toggle-components").click(function() {
        var components = $("#layout-components");
        setTimeout(function() {
            if (!components.hasClass("active")) {
                $("#toggle-components").addClass("active");
                components.addClass("active");
                components.slick("setPosition");
                document.getElementById("layout-components").scrollIntoView();
                setTimeout(function() {
                    $("#layout-components .slick-arrow").fadeIn(40);
                }, 10);
            } else {
                components.removeClass("active");
                components.removeClass("active");
                $("#layout-components .slick-arrow").fadeOut(40);
            }
        }, 100);
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
                key: key,
                config: config
            };

            console.log(data);
            items.push(data);
        });

        if ($("#result").length > 0) {
            $("#result").val(JSON.stringify(items));
        } else {
            var html = `<input type="hidden" id="result" value='${JSON.stringify(
                items
            )}' name="result">`;
            $("#LayoutUpdateForm").append(html);
            $("#LayoutUpdateForm").submit();
        }
    });

    $("#layout-components").slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 2,
        arrows: true
    });
    $("#layout-components .slick-arrow").hide();
});
