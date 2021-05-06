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

let css_folder = 'v2-assets/css';
let js_folder = 'v2-assets/js'

mix.js('resources/v2/js/app.js', js_folder)
    .js('resources/v2/js/admin.js', js_folder)
    .postCss('resources/v2/css/tw.css', css_folder, [require('tailwindcss')])
    .sass('resources/v2/css/admin.sass', css_folder);

mix.js('resources/beta/realtime/app.js', 'beta/realtime')
    .sass('resources/beta/realtime/app.sass', 'beta/realtime');