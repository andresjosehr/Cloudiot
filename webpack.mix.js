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
	.js('resources/js/custom/Vina.js', 'public/js/custom.js')
    .sass('resources/sass/general.scss', 'public/css/custom.css')
    .styles([
	    'resources/sass/default/bootstrap.css',
	    'resources/sass/default/waves.css',
	    'resources/sass/default/animate.css',
	    'resources/sass/default/style.css',
	    'resources/sass/default/all-themes.css',
	    'resources/sass/default/openlayer_4_6_5.css',
	    'resources/sass/default/bootstrap-select.css',
	    'resources/sass/default/bootstrap-material-datetimepicker.css',
	    'resources/sass/default/nouislider.min.css',
	    'resources/sass/default/rpm.css'
	], 'public/css/default.css')
	.scripts([
	    'resources/js/default/openlayer_4_5_6.js'
	], 'public/js/default.js');