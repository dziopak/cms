const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/app.js', 'js/langs.js')
    .sass( __dirname + '/Resources/assets/sass/lang.scss', 'public/css');

if (mix.inProduction()) {
    mix.version();
}