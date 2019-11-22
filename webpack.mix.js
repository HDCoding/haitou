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

mix.autoload({
    jquery: ['$', 'window.jQuery', 'jQuery'],
    popper: ['popper.js']
});

//Vendor JS
mix.combine([
    'node_modules/jquery/dist/jquery.slim.min.js',
    'node_modules/popper.js/dist/umd/popper.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js'], 'public/js/vendor.js');

//Vendor CSS
mix.combine([
    'node_modules/bootstrap/dist/css/bootstrap.css',

], 'public/css/vendor.css');

//App CSS
mix.combine([
    'resources/assets/css/appwork.css',
    'resources/assets/css/theme-corporate.css',
    'resources/assets/css/colors.css',
    'resources/assets/css/uikit.css',
    'resources/assets/css/demo.css'
], 'public/css/app.css');

//App JS
mix.combine([
    'resources/assets/js/dropdown-hover.js',
    'resources/assets/js/layout-helpers.js',
    'resources/assets/js/material-ripple.js',
    'resources/assets/js/pace.js',
    'resources/assets/js/demo.js'
], 'public/js/app.js');
