const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
        .js(['resources/js/jquery.rd-navbar.min.js', 'resources/js/owl.carousel.min.js', 'resources/js/jquery.flexslider.js', 'public/js/slick.min.js', 'public/js/xcustom.js'], 'public/js/visabadge.js')
        .styles(['resources/css/style.css', 'resources/css/rd-navbar.css', 'resources/css/owl.carousel.min.css', 'resources/css/flexslider.css'], 'public/css/all.css')
        .sass('resources/sass/app.scss', 'public/css')
        .version();
