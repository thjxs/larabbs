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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .copy('bower_components/simditor/styles/simditor.css', 'public/css/simditor.css')
   .copyDirectory('bower_components/simditor/lib', 'public/js')
   .copyDirectory('bower_components/simple-hotkeys/lib', 'public/js')
   .copyDirectory('bower_components/simple-uploader/lib', 'public/js')
   .copyDirectory('bower_components/simple-module/lib', 'public/js');
