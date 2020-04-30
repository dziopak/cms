const mix = require("laravel-mix");
require("dotenv").config();

let theme = process.env.THEME || "default";
let theme_path = "resources/views/themes/" + theme + "/";

require("laravel-mix-merge-manifest");
mix.mergeManifest();

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/admin/dashboard.js", "public/js/admin")
    .js("resources/js/admin/layouts.js", "public/js/admin")
    .js("resources/js/admin/defer.js", "public/js/admin")

    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/admin.scss", "public/css")
    .sass("resources/sass/admin/dashboard.scss", "public/css")
    .sass("resources/sass/admin/layouts.scss", "public/css")

    .copy("node_modules/slick-carousel/slick/slick.min.js", "public/assets/js")
    .copy("node_modules/slick-carousel/slick/slick.css", "public/assets/css")
    .copy("resources/assets/slick/slick-theme.css", "public/assets/css")

    .copy("node_modules/chart.js/dist/Chart.js", "public/assets/js")
    .copy("node_modules/chart.js/dist/Chart.min.css", "public/assets/css")

    .copy("node_modules/gridstack/dist/gridstack.all.js", "public/assets/js")
    .copy("node_modules/gridstack/dist/gridstack.min.css", "public/assets/css")

    .sass(
        theme_path + "assets/sass/theme.scss",
        "../" + theme_path + "assets/css"
    )
    .sass(
        theme_path + "assets/sass/custom.scss",
        "../" + theme_path + "assets/css"
    );
