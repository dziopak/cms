const mix = require("laravel-mix");
require("dotenv").config();

let theme = process.env.THEME || "default";
let theme_path = "resources/themes/" + theme + "/";

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/admin/dashboard.js", "public/js/admin")
    .js("resources/js/admin/layouts.js", "public/js/admin")
    .js("resources/js/admin/head.js", "public/js/admin")
    .js("resources/js/admin/defer.js", "public/js/admin")
    .js("resources/js/admin/menus.js", "public/js/admin")

    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/admin.scss", "public/css")
    .sass("resources/sass/admin/dashboard.scss", "public/css")
    .sass("resources/sass/admin/layouts.scss", "public/css")
    .sass("resources/sass/admin/menus.scss", "public/css")
    .sass("public/installer/css/scss/installer.scss", "public/css")
    .copy("resources/assets/nestable/nestable.js", "public/assets/js")

    .copy("node_modules/chart.js/dist/Chart.js", "public/assets/js")
    .copy("node_modules/chart.js/dist/Chart.min.css", "public/assets/css")

    .copy("node_modules/@glidejs/glide/dist/glide.min.js", "public/assets/js")

    .copy("node_modules/gridstack/dist/gridstack.all.js", "public/assets/js")
    .copy("node_modules/gridstack/dist/gridstack.min.css", "public/assets/css")

    .copy("node_modules/jquery/dist/jquery.min.js", "public/assets/js")

    .sass(
        theme_path + "assets/sass/theme.scss",
        "public/css/themes/"+theme+"/"
    )
    .sass(
        theme_path + "assets/sass/blocks.scss",
        "public/css/themes/"+theme+"/"
    )
    .sass(
        theme_path + "assets/sass/custom.scss",
        "public/css/themes/"+theme+"/"
    )
    .sass(
        theme_path + "modules/posts/style.scss",
        "public/css/themes/"+theme+"/posts.css"
    )
    .sass(
        theme_path + "modules/pages/style.scss",
        "public/css/themes/"+theme+"/pages.css"
    )
    .sass(
        theme_path + "modules/users/style.scss",
        "public/css/themes/"+theme+"/users.css"
    )
    .sass(
        theme_path + "modules/categories/style.scss",
        "public/css/themes/"+theme+"/categories.css"
    );
