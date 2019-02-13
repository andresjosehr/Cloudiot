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


mix.js('resources/js/custom/home.js', 'public/js/custom.js')
	.js('resources/js/custom/SicutIgnis.js', 'public/js/custom.js')
    .sass('resources/sass/general.scss', 'public/css/custom.css');