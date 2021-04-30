const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/v2/js/app.js', 'v2-assets/js')
    .postCss('resources/v2/css/app.css', 'v2-assets/css', [require('tailwindcss')]);

mix.js('resources/beta/realtime/app.js', 'beta/realtime')
    .sass('resources/beta/realtime/app.sass', 'beta/realtime');