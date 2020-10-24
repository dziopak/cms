$(document).ready(function() {
    $(".input-lang").click(function() {
        var langSwitcher = $(this).closest(".input-lang-switcher");
        var lang = $(this).data("lang");

        langSwitcher.find(".active").removeClass("active");
        $(this).addClass("active");

        var container = $(this).closest(".form-group");
        var field = container.find(".lang_origin").data("container-for");

        container.find(".lang").hide();

        if (lang === "default") {
            var target = container.find(".lang_origin");
        } else {
            var target = container.find(
                '.lang[data-container-for="' + field + "_" + lang + '"]'
            );
        }

        target.show();
        target.css("display", "block");
        langSwitcher.appendTo(target);
    });

    $(".input-lang").dblclick(function() {
        var lang = $(this).data("lang");
        $(".input-lang[data-lang='" + lang + "']").click();
    });
});
