let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix
    .js('resources/assets/js/inverter.js', 'public/js')
    .js('resources/assets/js/front.js', 'public/js')
    // .js('resources/assets/js/download.js', 'public/js')
    // .js('resources/assets/js/report.js', 'public/js')
    // .js('resources/assets/js/back.js', 'public/js')
    // .js('resources/assets/js/member.js', 'public/js')
    // .js('resources/assets/js/websetting.js', 'public/js')
    // .sass('resources/assets/sass/app.scss', 'public/css');